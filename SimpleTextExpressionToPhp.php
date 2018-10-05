<?php

namespace Slov\Expression;

use Slov\Expression\Operation\OperationSignRegexp;
use Slov\Expression\TextExpression\ExpressionList;
use Slov\Expression\TextExpression\TextOperation;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\TypeName;

/** Преобразователь псевдо-кода в php код */
class SimpleTextExpressionToPhp
{
    use FactoryRepository;

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
     * @param string $code псевдо код
     * @return string php-код
     * @throws ExpressionException
     */
    public function toPhp($code)
    {
        $operationList = $this->getOperationList($code);
        if(count($operationList) > 0){
            $maxTextOperation = $this->getMaxTextOperation($operationList);
            $operandList = $this->getTrimOperandList($code);
            $replacedExpressionText = $this->replaceExpressionText(
                $maxTextOperation, $operationList, $operandList
            );
            return $this->toPhp($replacedExpressionText);
        } else {
            return $this->getExpressionList()->exists($code)
                ? $this->getExpressionList()->get($code)->toPhp($code)
                : $this->createOperandToPhp()->toPhp($code);
        }
    }

    /**
     * @return Operand операнд
     */
    private function createOperandToPhp(): Operand
    {
        return new Operand();
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
     * @throws ExpressionException
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
            ->setCode($firstOperandValue)
            ->setExpressionList($this->getExpressionList());
        $secondOperand = $this
            ->createOperand()
            ->setCode($secondOperandValue)
            ->setExpressionList($this->getExpressionList());
        $operation = $this
            ->createOperation($textOperation)
            ->setFirstOperand($firstOperand)
            ->setSecondOperand($secondOperand)
            ->setCode($textOperation->getOperationValue());

        return $this
            ->createExpression()
            ->setOperation($operation)
            ->setFirstOperand($firstOperand)
            ->setSecondOperand($secondOperand);
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
        return $this->getOperationFactory()->create($textOperation);
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