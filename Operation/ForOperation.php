<?php

namespace Slov\Expression\Operation;

use Slov\Expression\TextExpression\ForStructure;

/** Операция for */
class ForOperation extends Operation
{
    use BooleanOperationTrait;

    /** @var ForStructure структура для цикла for */
    private $forStructure;

    /**
     * @return ForStructure структура для цикла for
     */
    public function getForStructure(): ForStructure
    {
        return $this->forStructure;
    }

    /**
     * @param ForStructure $forStructure
     * @return $this
     */
    public function setForStructure(ForStructure $forStructure)
    {
        $this->forStructure = $forStructure;
        return $this;
    }

    public function getOperationName()
    {
        return new OperationName(OperationName::FOR);
    }

    protected function calculateValues($firstOperandValue, $secondOperandValue)
    {
        for(
            $this->getForStructure()->getFirst()->calculate();
            $this->getForStructure()->getCondition()->calculate()->getValue();
            $this->getForStructure()->getEachStep()->calculate()
        ){
            $this->getForStructure()->getAction()->calculate();
        }
        return true;
    }
}