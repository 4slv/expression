<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\CodeAccessor;
use Slov\Expression\Operation\IfElseOperation;
use Slov\Expression\Operation\OperationName;
use Slov\Expression\Operation\OperationSignRegexp;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\TypeName;
use Slov\Expression\CodeToPhp;
use Slov\Expression\Expression;
use Slov\Expression\FactoryRepository;
use Slov\Expression\ExpressionException;
use Slov\Expression\Operand;

/** Выражение в текстовом представлении без скобок */
class SimpleTextExpression implements CodeToPhp
{
    use FactoryRepository;
    use CodeAccessor;

    /** @var ExpressionList список выражений */
    protected $expressionList;

    /**
     * @return ExpressionList список выражений
     */
    public function getExpressionList()
    {
        if(is_null($this->expressionList))
        {
            $this->expressionList = new ExpressionList();
        }
        return $this->expressionList;
    }

    /**
     * @param ExpressionList $expressionList список выражений
     * @return $this
     */
    public function setExpressionList($expressionList)
    {
        $this->expressionList = $expressionList;
        return $this;
    }

    /**
     * @return mixed
     * @throws ExpressionException
     */
    public function execute()
    {
        $phpCode = $this->toPhp($this->getCode());
        return eval('return '. $phpCode. ';');
    }

    public function toPhp($code)
    {
        $codeWithoutComments = preg_replace(
            '/\/\*.*?\*\//', '', $code
        );
        return $this->toPhpWithoutComments($codeWithoutComments);
    }

    /**
     * @param string $code псевдо код
     * @return string php-код
     * @throws ExpressionException
     */
    protected function toPhpWithoutComments($code)
    {
        return $this->toExpression($code)->toPhp($code);
    }

    /**
     * @param string $code псевдо код
     * @return Expression
     * @throws ExpressionException
     */
    public function toExpression($code): Expression
    {
        $operationList = $this->getOperationList($code);
        if(count($operationList) > 0){
            $maxTextOperation = $this->getMaxTextOperation($operationList);
            $operandList = $this->getTrimOperandList($code);
            $replacedExpressionText = $this->replaceExpressionText(
                $maxTextOperation, $operationList, $operandList
            );
            return $this->toExpression($replacedExpressionText);
        } else {
            return $this->getExpressionList()->exists($code)
                ? $this->getExpressionList()->get($code)
                : $this->createExpressionFromSingleOperand($code);
        }
    }

    /**
     * @return string[] список экранированных символов операций для регулярного выражения
     */
    private function getRegexpSignList()
    {
        $signRegexpList = OperationSignRegexp::getConstants();
        /* @var string[] $signRegexpList */
        return $signRegexpList;
    }

    /**
     * @return string регулярное выражение выбирающее операции
     */
    private function getOperationListRegexp()
    {
        $signListRegexp = implode('|', $this->getRegexpSignList());
        $operationListRegexp = '#('. $signListRegexp. ')#';
        return $operationListRegexp;
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return string[] список операций
     */
    private function getOperationList($expressionText)
    {
        preg_match_all($this->getOperationListRegexp(), $expressionText, $match);
        return $match[0];
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return string[]
     */
    private function getOperandList($expressionText)
    {
        return preg_split($this->getOperationListRegexp(), $expressionText);
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return string[]
     */
    private function getTrimOperandList($expressionText)
    {
        return array_map(
            function($operand){
                return trim($operand);
            },
            $this->getOperandList($expressionText)
        );
    }

    /**
     * @param string $operationValue текстовое представление операции
     * @param int $position позиция в выражении
     * @return TextOperation
     * @throws ExpressionException
     */
    private function createTextOperation($operationValue, $position)
    {
        $operationName = OperationSignRegexp::getOperationName($operationValue);
        $textOperation = new TextOperation();
        return $textOperation
            ->setOperationValue($operationValue)
            ->setOperationName($operationName)
            ->setPosition($position);
    }

    /**
     * @param string[] $operationList список операций
     * @return TextOperation максимальная по приоритету и позиции текстовая операция
     * @throws ExpressionException
     */
    private function getMaxTextOperation($operationList)
    {
        $textOperationList = [];

        foreach($operationList as $operationPosition => $operationSign){
            $textOperationList[] = $this->createTextOperation($operationSign, $operationPosition);
        }

        $maxTextOperation = null;

        foreach ($textOperationList as $textOperation)
        {
            if(isset($maxTextOperation)){
                /** @var TextOperation $maxTextOperation */
                if($textOperation->grater($maxTextOperation)){
                    $maxTextOperation = $textOperation;
                }
            } else {
                $maxTextOperation = $textOperation;
            }
        }
        return $maxTextOperation;
    }

    /**
     * @param TextOperation $textOperation операция выражения в текстовом представлении
     * @param string[] $operationSignList список знаков операций
     * @param string[] $operandList список операндв операций
     * @return string текстовое представление выражения в котом заменена одна операция на метку с выражением
     */
    private function replaceExpressionText(TextOperation $textOperation, $operationSignList, $operandList)
    {
        $expression = $this->createExpressionFromOperationAndOperands($textOperation, $operandList);
        $expressionLabel = $this->appendExpression($expression);
        $operationPosition = $textOperation->getPosition();

        $operation = $textOperation->getOperationName();

        $expressionTextParts = [];
        foreach($operandList as $position => $operand){
            if(
                ($position !== $operationPosition || $operation->leftOperandUsed() === false)
                &&
                ($position !== $operationPosition + 1 || $operation->rightOperandUsed() === false)
            ) {
                $expressionTextParts[] = $operand;
            }
            if(array_key_exists($position, $operationSignList)){
                $operationSign = $operationSignList[$position];
                $expressionTextParts[] = $position === $operationPosition
                    ? $expressionLabel
                    : $operationSign;
            }
        }

        return implode('', $expressionTextParts);
    }

    /**
     * @param TextOperation $textOperation текстовая операция
     * @param string[] $operandList список операндов
     * @return Expression выражение
     */
    private function createExpressionFromOperationAndOperands(TextOperation $textOperation, $operandList)
    {
        $operationPosition = $textOperation->getPosition();
        $operation = $textOperation->getOperationName();
        $firstOperandValue = $operation->leftOperandUsed() ? $operandList[$operationPosition] : '';
        $secondOperandValue = $operation->rightOperandUsed() ? $operandList[$operationPosition + 1] : '';
        $firstOperand = $this
            ->createOperand()
            ->setExpressionList($this->getExpressionList())
            ->setCode($firstOperandValue);
        $secondOperand = $this
            ->createOperand()
            ->setExpressionList($this->getExpressionList())
            ->setCode($secondOperandValue);
        $operation = $this
            ->createOperation($textOperation)
            ->setExpressionList($this->getExpressionList())
            ->setFirstOperand($firstOperand)
            ->setSecondOperand($secondOperand)
            ->setCode($textOperation->getOperationValue());

        return $this
            ->createExpression()
            ->setOperation($operation)
            ->setFirstOperand($firstOperand)
            ->setSecondOperand($secondOperand)
            ->setUseBrackets(false);
    }

    /** Получение выражения из одиночного операнда
     * @param string $code псевдо код
     * @return Expression выражение */
    private function createExpressionFromSingleOperand($code)
    {
        $firstOperand = $this
            ->createOperand()
            ->setExpressionList($this->getExpressionList())
            ->setCode($code);

        $operation = $this
            ->getOperationFactory()
            ->createGetFirstOperandOperation()
            ->setExpressionList($this->getExpressionList())
            ->setCode($code)
            ->setFirstOperand($firstOperand);

        return $this
            ->createExpression()
            ->setFirstOperand($firstOperand)
            ->setSecondOperand($firstOperand)
            ->setOperation($operation)
            ->setUseBrackets(false);
    }

    /**
     * @return Operand операнд
     */
    private function createOperand()
    {
        return new Operand();
    }

    /**
     * @param TextOperation $textOperation
     * @return Operation
     */
    private function createOperation(TextOperation $textOperation)
    {
        $operation = $this
            ->getOperationFactory()
            ->create($textOperation);

        $operationCode = $textOperation->getOperationValue();

        switch($textOperation->getOperationName()->getValue())
        {
            case OperationName::IF_ELSE:
                /* @var IfElseOperation $operation */
                $this->initIfElseOperation($operation, $operationCode);
                break;
        }

        return $operation;
    }

    /**
     * @param IfElseOperation $operation операция
     * @param string $operationCode псевдо-код операции
     * @throws ExpressionException
     */
    private function initIfElseOperation($operation, $operationCode)
    {
        if(preg_match('/^'. OperationSignRegexp::IF_ELSE. '$/', $operationCode, $match))
        {
            $condition = $this
                ->createTextExpression()
                ->toExpression(trim($match[1]));

            $trueResult = $this
                ->createTextExpression()
                ->toExpression(trim($match[2]));

            $falseResult = $this
                ->createTextExpression()
                ->toExpression(trim($match[3]));

            $ifElseStructure = $this
                ->createIfElseStructure($condition, $trueResult, $falseResult);

            $operation->setIfElseStructure($ifElseStructure);
        }
    }

    /**
     * @return TextExpression преобразователь псевдо-кода в php код
     */
    protected function createTextExpression()
    {
        $textExpression = new TextExpression();
        return $textExpression
            ->setExpressionList($this->getExpressionList());
    }

    /**
     * @param Expression $condition логическое условие
     * @param Expression $trueResult результат в случае если условие истина
     * @param Expression $falseResult результат в случае если условие ложь
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
     * @return Expression выражение
     */
    protected function createExpression()
    {
        return new Expression();
    }

    /** Добавление выражения в список
     * @param Expression $expression выражение
     * @return string текстовая метка выражения
     */
    protected function appendExpression(Expression $expression)
    {
        $expressionNumber = $this->getExpressionList()->size();
        $expressionName = TypeName::EXPRESSION . $expressionNumber;
        $this->getExpressionList()->append($expressionName, $expression);
        return $expressionName;
    }

}