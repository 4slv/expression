<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Expression;

/** Операция условный оператор */
class IfElseOperation extends Operation
{
    /** @var Expression условное выражение */
    protected $ifElseExpression;

    /**
     * @return Expression
     */
    public function getIfElseExpression(): Expression
    {
        return $this->ifElseExpression;
    }

    /**
     * @param Expression $ifElseExpression
     * @return IfElseOperation
     */
    public function setIfElseExpression(Expression $ifElseExpression) : IfElseOperation
    {
        $this->ifElseExpression = $ifElseExpression;
        return $this;
    }

    /**
     * @return OperationName
     */
    public function getOperationName() : OperationName
    {
        return new OperationName(OperationName::IF_ELSE);
    }

    protected function createZero(){}

    protected function calculateValues($firstOperandValue, $secondOperandValue){}

    protected function resolveReturnTypeName(){}

    /**
     * Если результат сравнения - true, то возвращается первый операнд, если false - второй
     * @return \Slov\Expression\Calculation|Expression|\Slov\Expression\Type\Type
     * @throws \Slov\Expression\CalculationException
     */
    public function calculate()
    {
        $operation = $this->getIfElseExpression()->getOperation();

        $firstOperand = $this->getIfElseExpression()->getFirstOperand();
        $secondOperand = $this->getIfElseExpression()->getSecondOperand();
        if($firstOperand instanceof Expression and $secondOperand instanceof Expression) {
            $firstOperand = $firstOperand->calculate();
            $secondOperand = $secondOperand->calculate();
            $boolResult = $operation->calculateValues($firstOperand, $secondOperand);
        } else {
            $boolResult = $operation->calculateValues($firstOperand->getValue(), $secondOperand->getValue());
        }

        $resultOperation = $boolResult ? $firstOperand : $secondOperand;

        return $resultOperation;
    }
}