<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Expression;
use Slov\Expression\Operation\FunctionOperation;
use Slov\Expression\Operation\OperationName;
use Slov\Expression\Operation\OperationSign;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\Type;
use Slov\Expression\ExpressionException;
use Slov\Expression\Type\TypeRegExp;

/** Выражение в текстовом представлении без скобок */
class SimpleTextExpression extends TextExpression
{
    /**
     * @param string $operationSignValue знак операции
     * @param int $position позиция в выражении
     * @return TextOperation
     */
    protected function createTextOperation($operationSignValue, $position)
    {
        $operationSign = new OperationSign($operationSignValue);
        $operationKey = $operationSign->getKey();
        $operationNameValue = constant(OperationName::class. '::'. $operationKey);
        $operationName = new OperationName($operationNameValue);
        $textOperation = new TextOperation();
        return $textOperation
            ->setOperationSign($operationSign)
            ->setOperationName($operationName)
            ->setPosition($position);
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
        $operationSignList = $this->getOperationSignList($expressionText);
        if(count($operationSignList) > 0){
            $textOperationList = [];
            foreach($operationSignList as $operationPosition => $operationSign){
                $textOperationList[] = $this->createTextOperation($operationSign, $operationPosition);
            }
            $maxTextOperation = $this->getMaxTextOperation($textOperationList);

            $operandList = $this->getTrimOperandList($expressionText);

            $replacedExpressionText = $this->replaceExpressionText($maxTextOperation, $operationSignList, $operandList);

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
        $operation = $this->getOperationFactory()->create($textOperation->getOperationName());

        return $this
            ->createExpression()
            ->setOperation($operation)
            ->setFirstOperand($firstOperand)
            ->setSecondOperand($secondOperand);
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
                return $this->getVariable($operand);
            case TypeName::FUNCTION:
                return $this->getFunction($operand);
            case TypeName::IF_ELSE:
                return $this->getIfElse($operand);
            default:
                return $this->getTypeFactory()->createFromString($operand);
        }
    }

    /**
     * @param string $variableText текстовое представление переменной
     * @return Expression|Type
     */
    protected function getVariable($variableText)
    {
        if(preg_match('/^'. TypeRegExp::VARIABLE. '$/', $variableText, $match))
        {
            $variableName = $match[1];
            return $this->getVariableList()->get($variableName);
        }
        return $this->getTypeFactory()->createNull();
    }

    /**
     * @param string $functionText текстовое представление функции
     * @return Expression|Type
     */
    protected function getFunction($functionText)
    {
        if(preg_match('/^'. TypeRegExp::FUNCTION. '$/', $functionText, $match))
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
            return $this->getFunctionExpression($functionStructure, $functionParameterList);
        }
        return $this->getTypeFactory()->createNull();
    }

    /**
     * @param string $ifElseOperationText текстовое представление логической операции
     * @return Expression|\Slov\Expression\Type\NullType
     * @throws ExpressionException
     */
    protected function getIfElse(string $ifElseOperationText)
    {
        if(preg_match('/^'. TypeRegExp::IF_ELSE. '$/', $ifElseOperationText, $match))
        {
            $textExpression = preg_replace("/(\{|\})/", "", $match[0]);
            $expression = $this->createTextExpression($textExpression)
                ->toExpression();

            return $this->getIfElseExpression($expression);
        }
        return $this->getTypeFactory()->createNull();
    }

    /**
     * @param FunctionStructure $functionStructure
     * @param Expression[] $functionParameterList
     * @return Expression
     */
    protected function getFunctionExpression($functionStructure, $functionParameterList)
    {
        $functionOperation = $this->getFunctionOperation($functionStructure, $functionParameterList);
        return $this
            ->createExpression()
            ->setOperation($functionOperation)
            ->setFirstOperand($this->getTypeFactory()->createNull())
            ->setSecondOperand($this->getTypeFactory()->createNull());
    }

    /**
     * @param Expression $ifElseExpression
     * @return \Slov\Expression\Operation\IfElseOperation
     */
    protected function getIfElseOperation(Expression $ifElseExpression)
    {
        return $this
            ->getOperationFactory()
            ->createIfElseOperation()
            ->setIfElseExpression($ifElseExpression);
    }

    /**
     * @param Expression $ifElseExpression
     * @return Expression
     */
    protected function getIfElseExpression(Expression $ifElseExpression)
    {
        $elseIfOperation = $this->getIfElseOperation($ifElseExpression);
        return $this
            ->createExpression()
            ->setOperation($elseIfOperation)
            ->setFirstOperand($this->getTypeFactory()->createNull())
            ->setSecondOperand($this->getTypeFactory()->createNull());
    }

    /**
     * @param FunctionStructure $functionStructure
     * @param Expression[] $functionParameterList
     * @return FunctionOperation
     */
    protected function getFunctionOperation($functionStructure, $functionParameterList)
    {
        return $this
            ->getOperationFactory()
            ->createFunctionOperation()
            ->setFunctionStructure($functionStructure)
            ->setFunctionParameterList($functionParameterList);
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