<?php

namespace Slov\Expression;

use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\Type;

/** Выражение */
class Expression implements Calculation
{
    /** @var Calculation первый операнд */
    protected $firstOperand;

    /** @var Calculation второй операнд */
    protected $secondOperand;

    /** @var Operation операция */
    protected $operation;

    /** @var Type результат рассчёта первого операнда */
    protected $firstOperandResult;

    /** @var Type результат рассчёта второго операнда */
    protected $secondOperandResult;

    /**
     * @return Calculation первый операнд
     */
    public function getFirstOperand(): Calculation
    {
        return $this->firstOperand;
    }

    /**
     * @param Calculation $firstOperand первый операнд
     * @return $this
     */
    public function setFirstOperand(Calculation $firstOperand)
    {
        $this->firstOperand = $firstOperand;
        return $this;
    }

    /**
     * @return Calculation второй операнд
     */
    public function getSecondOperand(): Calculation
    {
        return $this->secondOperand;
    }

    /**
     * @param Calculation $secondOperand второй операнд
     * @return $this
     */
    public function setSecondOperand(Calculation $secondOperand)
    {
        $this->secondOperand = $secondOperand;
        return $this;
    }

    /**
     * @return Operation операция
     */
    public function getOperation(): Operation
    {
        return $this->operation;
    }

    /**
     * @param Operation $operation операция
     * @return $this
     */
    public function setOperation(Operation $operation)
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return Type результат рассчёта первого операнда
     */
    protected function getFirstOperandResult(): Type
    {
        return $this->firstOperandResult;
    }

    /**
     * @param Type $firstOperandResult результат рассчёта первого операнда
     */
    protected function setFirstOperandResult(Type $firstOperandResult)
    {
        $this->firstOperandResult = $firstOperandResult;
    }

    /**
     * @return Type результат рассчёта второго операнда
     */
    protected function getSecondOperandResult(): Type
    {
        return $this->secondOperandResult;
    }

    /**
     * @param Type $secondOperandResult результат рассчёта второго операнда
     */
    protected function setSecondOperandResult(Type $secondOperandResult)
    {
        $this->secondOperandResult = $secondOperandResult;
    }


    public function calculate()
    {
        if($this->getFirstOperandPriority() >= $this->getSecondOperandPriority())
        {
            $this->setFirstOperandResult($this->getFirstOperand()->calculate());
            $this->setSecondOperandResult($this->getSecondOperand()->calculate());
        } else {
            $this->setSecondOperandResult($this->getSecondOperand()->calculate());
            $this->setFirstOperandResult($this->getFirstOperand()->calculate());
        }

        return $this
            ->getOperation()
            ->setFirstOperand($this->getFirstOperandResult())
            ->setSecondOperand($this->getSecondOperandResult())
            ->calculate();
    }

    /**
     * @param Calculation $operand операнд
     * @return int приоритет рассчёта операнда
     */
    protected function getOperandPriority(Calculation $operand)
    {
        if($operand instanceof Expression)
        {
            /* @var Expression $operand */
            return $operand->getOperation()->getOperationName()->getPriority();
        } else {
            return 0;
        }
    }

    /**
     * @return int приоритет рассчёта первого операнда
     */
    protected function getFirstOperandPriority()
    {
        return $this->getOperandPriority($this->getFirstOperand());
    }

    /**
     * @return int приоритет рассчёта второго операнда
     */
    protected function getSecondOperandPriority()
    {
        return $this->getOperandPriority($this->getSecondOperand());
    }
}