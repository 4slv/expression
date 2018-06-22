<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Expression;

/** Операция условный оператор */
class IfElseOperation extends Operation
{
    /** @var bool результат выполнения основного условия */
    private $resultOperaion;

    /**
     * @return bool
     */
    public function getResultOperation(): bool
    {
        return $this->resultOperaion;
    }

    /**
     * @param bool $resultOperaion
     * @return this
     */
    public function setResultOperation(bool $resultOperaion) : IfElseOperation
    {
        $this->resultOperaion = $resultOperaion;

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
     * @return \Slov\Expression\Calculation|Expression|\Slov\Expression\Type\Type
     * @throws \Slov\Expression\CalculationException
     */
    public function calculate()
    {
        return $this->getResultOperation() === true ? $this->getFirstOperand() : $this->getSecondOperand();
    }
}