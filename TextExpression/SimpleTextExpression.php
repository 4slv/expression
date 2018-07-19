<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Expression;
use Slov\Expression\Operation\AssignOperation;
use Slov\Expression\Operation\ForOperation;
use Slov\Expression\Operation\FunctionOperation;
use Slov\Expression\Operation\IfElseOperation;
use Slov\Expression\Operation\OperationName;
use Slov\Expression\Operation\OperationSign;
use Slov\Expression\Operation\OperationSignRegexp;
use Slov\Expression\Type\BooleanType;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\Type;
use Slov\Expression\ExpressionException;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\VariableType;

/** Выражение в текстовом представлении без скобок */
class SimpleTextExpression extends TextExpression
{
    /**
     * @param string $operationValue текстовое представление операции
     * @param int $position позиция в выражении
     * @return TextOperation
     */
    protected function createTextOperation($operationValue, $position)
    {
        $operationSignValue = $this->getOperationSignValue($operationValue);
        $operationSign = new OperationSign($operationSignValue);
        $operationKey = $operationSign->getKey();
        $operationNameValue = constant(OperationName::class. '::'. $operationKey);
        $operationName = new OperationName($operationNameValue);
        $textOperation = new TextOperation();
        return $textOperation
            ->setOperationValue($operationValue)
            ->setOperationSign($operationSign)
            ->setOperationName($operationName)
            ->setPosition($position);
    }

    /**
     * @param string $operationValue текстовое представление операции
     * @return string знак операции
     * @throws ExpressionException
     */
    protected function getOperationSignValue($operationValue)
    {
        foreach($this->getRegexpSignList() as $signKey => $signRegExp)
        {
            if(preg_match('/^'. $signRegExp. '$/', $operationValue)){
                return constant(OperationSign::class . '::'. $signKey);
            }
        }
        throw new ExpressionException('Unknown operation: '. $operationValue);
    }

    /**
     * @return Expression выражение
     * @throws ExpressionException
     */
    public function toExpression()
    {
        return $this->createExpressionFromTextExpression($this->getExpressionText());
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return Expression выражение
     * @throws ExpressionException
     */
    private function createExpressionFromTextExpression($expressionText)
    {
        $operationList = $this->getOperationList($expressionText);

        if(count($operationList) > 0){
            $textOperationList = [];

            foreach($operationList as $operationPosition => $operationSign){
                $textOperationList[] = $this->createTextOperation($operationSign, $operationPosition);
            }
            $maxTextOperation = $this->getMaxTextOperation($textOperationList);

            $operandList = $this->getTrimOperandList($expressionText);

            $replacedExpressionText = $this->replaceExpressionText($maxTextOperation, $operationList, $operandList);

            return $this->createExpressionFromTextExpression($replacedExpressionText);
        } else {
            return $this->getOperandFromString($expressionText);
        }
    }

    /**
     * @param TextOperation $textOperation операция выражения в текстовом представлении
     * @param string[] $operationSignList список знаков операций
     * @param string[] $operandList список операндв операций
     * @return string текстовое представление выражения в котом заменена одна операция на метку с выражением
     * @throws ExpressionException
     */
    private function replaceExpressionText(TextOperation $textOperation, $operationSignList, $operandList)
    {
        $expression = $this->createExpressionFromOperationAndOperands($textOperation, $operandList);
        $expressionLabel = $this->appendExpression($expression);
        $operationPosition = $textOperation->getPosition();

        $operandListWithoutExpressionOperands = $operandList;
        array_splice($operandListWithoutExpressionOperands, $operationPosition, 2, $expressionLabel);
        $operationSignListWithoutExpressionOperation = $operationSignList;
        array_splice($operationSignListWithoutExpressionOperation, $operationPosition, 1);

        $expressionTextParts = [];
        foreach($operationSignListWithoutExpressionOperation as $position => $operationSign){
            $operand = $operandListWithoutExpressionOperands[$position];
            $expressionTextParts[] = $operand;
            $expressionTextParts[] = $operationSign;
        }
        $lastOperand = array_pop($operandListWithoutExpressionOperands);
        $expressionTextParts[] = $lastOperand;

        return implode('', $expressionTextParts);

    }

    /**
     * @return Expression выражение
     */
    protected function createExpression()
    {
        return new Expression();
    }

    /**
     * @param TextOperation $textOperation текстовая операция
     * @param string[] $operandList список операндов
     * @return Expression выражение
     * @throws ExpressionException
     */
    protected function createExpressionFromOperationAndOperands(TextOperation $textOperation, $operandList)
    {
        $operationPosition = $textOperation->getPosition();
        $firstOperandValue = $operandList[$operationPosition];
        $secondOperandValue = $operandList[$operationPosition + 1];
        $firstOperand = $this->getOperandFromString($firstOperandValue);
        $secondOperand = $this->getOperandFromString($secondOperandValue);
        $operation = $this->createOperation($textOperation);

        return $this
            ->createExpression()
            ->setOperation($operation)
            ->setFirstOperand($firstOperand)
            ->setSecondOperand($secondOperand)
            ->setTextDescription($firstOperandValue. " ". $textOperation->getOperationValue(). " ". $secondOperandValue);
    }

    /**
     * @param TextOperation $textOperation
     * @return Operation
     */
    protected function createOperation(TextOperation $textOperation)
    {
        $operation = $this
            ->getOperationFactory()
            ->create($textOperation->getOperationName());
        $operationValue = $textOperation->getOperationValue();

        switch($textOperation->getOperationName()->getValue())
        {
            case OperationName::IF_ELSE:
                /* @var IfElseOperation $operation */
                $this->initIfElseOperation($operation, $operationValue);
                break;
            case OperationName::FUNCTION:
                /* @var FunctionOperation $operation */
                $this->initFunctionOperation($operation, $operationValue);
                break;
            case OperationName::ASSIGN:
                /* @var AssignOperation $operation */
                $this->initAssignOperation($operation, $operationValue);
                break;
            case OperationName::FOR:
                /* @var ForOperation $operation */
                $this->initForOperation($operation, $operationValue);
        }

        return $operation;
    }

    /**
     * @param ForOperation $operation операция for
     * @param string $forOperationText текстовое представление операции for
     */
    private function initForOperation($operation, $forOperationText)
    {
        if(preg_match('/^'. OperationSignRegexp::FOR. '$/', $forOperationText, $match))
        {
            $first = $this->createTextExpression(trim($match[1]))->toExpression();
            $condition = $this->createTextExpression(trim($match[2]))->toExpression();
            $eachStep = $this->createTextExpression(trim($match[3]))->toExpression();
            $action = $this->createTextExpression(trim($match[4]))->toExpression();

            $forStructure = $this->createForStructure($first, $condition, $eachStep, $action);
            $operation->setForStructure($forStructure);
        }
    }

    /**
     * @param Expression $first выражение выполняющееся первым
     * @param Expression $condition логическое выражение, пока true - цикл не завершается
     * @param Expression $eachStep выражение выполняющееся каждый шаг
     * @param Expression $action выражение, которое необходимо многократно повторить
     * @return ForStructure
     */
    private function createForStructure($first, $condition, $eachStep, $action)
    {
        $forStructure = new ForStructure();
        return $forStructure
            ->setFirst($first)
            ->setCondition($condition)
            ->setEachStep($eachStep)
            ->setAction($action);
    }

    /**
     * @param IfElseOperation $operation операция
     * @param string $ifElseOperationText выражения в виде тернарного оператора
     */
    private function initIfElseOperation($operation, $ifElseOperationText)
    {
        if(preg_match('/^'. OperationSignRegexp::IF_ELSE. '$/', $ifElseOperationText, $match))
        {
            $condition = $this
                ->createTextExpression(trim($match[1]))
                ->toExpression();

            $trueResult = $this
                ->createTextExpression(trim($match[2]))
                ->toExpression();

            $falseResult = $this
                ->createTextExpression(trim($match[3]))
                ->toExpression();

            $ifElseStructure = $this->createIfElseStructure($condition, $trueResult, $falseResult);

            $operation->setIfElseStructure($ifElseStructure);
        }
    }

    /**
     * @param Expression|BooleanType $condition логическое условие
     * @param Expression|Type $trueResult результат в случае если условие истина
     * @param Expression|Type $falseResult результат в случае если условие ложь
     * @return IfElseStructure
     */
    private function createIfElseStructure($condition, $trueResult, $falseResult): IfElseStructure
    {
        $ifElseStructure = new IfElseStructure();
        return $ifElseStructure
            ->setCondition($condition)
            ->setTrueResult($trueResult)
            ->setFalseResult($falseResult);
    }

    /**
     * @param FunctionOperation $operation операция
     * @param string $functionText текстовое представление функции
     */
    private function initFunctionOperation($operation, $functionText)
    {
        if(preg_match('/^'. OperationSignRegexp::FUNCTION. '$/', $functionText, $match))
        {
            $functionName = $match[1];
            $functionParameterList = [];
            if(isset($match[2])) {
                $functionTextParametersString = $match[2];
                $functionTextParameterList = explode(',', $functionTextParametersString);
                foreach ($functionTextParameterList as $functionTextParameter) {
                    $functionParameterList[] = $this
                        ->createTextExpression(trim($functionTextParameter))
                        ->toExpression();
                }
            }
            $functionStructure = $this->getFunctionList()->get($functionName);
            $operation
                ->setFunctionStructure($functionStructure)
                ->setFunctionParameterList($functionParameterList);
        }
    }

    /**
     * @param AssignOperation $operation операция присваивания
     * @param string $assignText текстовое представление присвоения
     */
    private function initAssignOperation($operation, $assignText)
    {
        if(preg_match('/^'. OperationSignRegexp::ASSIGN. '$/', $assignText, $match))
        {
            $variableName = $match[1];
            $operation
                ->setVariableName($variableName)
                ->setVariableList($this->getVariableList());
        }
    }

    /**
     * @param string $operand текстовое представление операнда
     * @return Expression|Type
     * @throws ExpressionException
     */
    protected function getOperandFromString($operand)
    {
        $typeName = $this->getOperandType($operand);

        switch ($typeName->getValue())
        {
            case TypeName::EXPRESSION:
                return $this->getExpressionByText($operand);
            case TypeName::VARIABLE:
                /* @var VariableType $variableType */
                $variableType = $this->getTypeFactory()->createFromString($operand);
                return $variableType->setVariableList($this->getVariableList());
            default:
                return $this->getTypeFactory()->createFromString($operand);
        }
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return TextExpression выражение в текстовом представлении со скобками
     */
    protected function createTextExpression($expressionText)
    {
        $textExpression = new TextExpression();
        return $textExpression
            ->setExpressionText($expressionText)
            ->setExpressionList($this->getExpressionList())
            ->setVariableList($this->getVariableList())
            ->setFunctionList($this->getFunctionList());
    }

    /**
     * @param TextOperation[] $textOperationList список операций
     * @return TextOperation[] отсортированный по приоритету и позиции список операций
     */
    protected function sortTextOperationList($textOperationList)
    {
        usort($textOperationList, function(TextOperation $leftOperation, TextOperation $rightOperation){
            $leftOperationPriority = $leftOperation->getOperationName()->getPriority();
            $rightOperationPriority = $rightOperation->getOperationName()->getPriority();
            $leftOperationPosition = $leftOperation->getPosition();
            $rightOperationPosition = $rightOperation->getPosition();
            if($leftOperationPriority === $rightOperationPriority)
            {
                if($leftOperationPosition === $rightOperationPosition)
                {
                    return 0;
                }
                return $leftOperationPosition > $rightOperationPosition ? -1 : 1;
            }
            return $leftOperationPriority < $rightOperationPriority ? -1 : 1;
        });

        return $textOperationList;
    }

    /**
     * @param TextOperation[] $textOperationList список операций
     * @return TextOperation максимальная по приоритету и позиции текстовая операция
     */
    protected function getMaxTextOperation($textOperationList)
    {
        $sortedTextOperationList = $this->sortTextOperationList($textOperationList);
        return array_pop($sortedTextOperationList);
    }

}