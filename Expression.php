<?php

namespace Slov\Expression;

use Slov\Expression\Interfaces\Operand;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\Type;
use Slov\Expression\Type\TypeFactory;
use Slov\Expression\Type\TypeName;

/** Выражение */
class Expression implements Calculation, Operand
{
    /** @var Calculation первый операнд */
    private $firstOperand;

    /** @var Calculation второй операнд */
    private $secondOperand;

    /** @var Operation операция */
    private $operation;

    /** @var Type результат рассчёта первого операнда */
    private $firstOperandResult;

    /** @var Type результат рассчёта второго операнда */
    private $secondOperandResult;

    /** @var string текстовое описание выражения */
    private $textDescription;

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
    protected function getFirstOperandResult()
    {
        return $this->firstOperandResult;
    }

    /**
     * @param Type $firstOperandResult результат рассчёта первого операнда
     */
    protected function setFirstOperandResult( $firstOperandResult)
    {
        $this->firstOperandResult = $firstOperandResult;
    }

    /**
     * @return Type результат рассчёта второго операнда
     */
    protected function getSecondOperandResult()
    {
        return $this->secondOperandResult;
    }

    /**
     * @param Type $secondOperandResult результат рассчёта второго операнда
     */
    protected function setSecondOperandResult( $secondOperandResult)
    {
        $this->secondOperandResult = $secondOperandResult;
    }

    /**
     * @return string текстовое описание выражения
     */
    public function getTextDescription(): ?string
    {
        return $this->textDescription;
    }

    /**
     * @param string $textDescription текстовое описание выражения
     * @return $this
     */
    public function setTextDescription(?string $textDescription)
    {
        $this->textDescription = $textDescription;
        return $this;
    }

    public function calculate()
    {
        $this->setFirstOperandResult($this->getFirstOperand()->calculate());
        $this->setSecondOperandResult($this->getSecondOperand()->calculate());

        try {
            return $this
                ->getOperation()
                ->setFirstOperand($this->getFirstOperandResult())
                ->setSecondOperand($this->getSecondOperandResult())
                ->calculate();
        } catch (CalculationException $exception)
        {
            throw new CalculationException(
                $exception->getMessage().
                "\n===\n".
                $this->getTextDescription()
            );
        }
    }

    public function getType()
    {
        return TypeName::EXPRESSION();
    }

}