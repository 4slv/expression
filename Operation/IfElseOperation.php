<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Expression;
use Slov\Expression\TextExpression\IfElseStructure;
use Slov\Expression\Calculation;
use Slov\Expression\Type\Type;

/** Операция условный оператор */
class IfElseOperation extends Operation
{
    /** @var IfElseStructure структура условного оператора */
    private $ifElseStructure;

    /**
     * @return IfElseStructure
     */
    protected function getIfElseStructure(): IfElseStructure
    {
        return $this->ifElseStructure;
    }

    /**
     * @param IfElseStructure $ifElseStructure
     * @return $this
     */
    public function setIfElseStructure(IfElseStructure $ifElseStructure) : IfElseOperation
    {
        $this->ifElseStructure = $ifElseStructure;
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
     * @return Calculation|Expression|Type
     */
    public function calculate()
    {
        $ifElseStructure = $this->getIfElseStructure();

        return $ifElseStructure->getCondition()->calculate()->getValue()
            ? $ifElseStructure->getTrueResult()->calculate()
            : $ifElseStructure->getFalseResult()->calculate();
    }
}