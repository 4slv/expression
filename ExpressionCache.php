<?php


namespace Slov\Expression;


class ExpressionCache extends Expression
{


    public function calculate()
    {
        $this->setFirstOperandResult($this->getFirstOperand()->calculate());
        $this->setSecondOperandResult($this->getSecondOperand()->calculate());
        dump($this
            ->getOperation()
            ->setFirstOperand($this->getFirstOperandResult())
            ->setSecondOperand($this->getSecondOperandResult())
            ->generatePhpCode());exit;
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
}