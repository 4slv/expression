<?php

namespace Slov\Expression\Operation;

use Slov\Expression\TextExpression\IfStructure;
use Slov\Expression\Type\TypeName;


/** Операция условный оператор if */
class IfOperation extends Operation
{
    /** @var IfStructure структура условного оператора */
    private $ifStructure;

    /**
     * @return IfStructure
     */
    protected function getIfStructure(): IfStructure
    {
        return $this->ifStructure;
    }

    /**
     * @param IfStructure $ifStructure
     * @return $this
     */
    public function setIfStructure(IfStructure $ifStructure)
    {
        $this->ifStructure = $ifStructure;
        return $this;
    }

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return $this->getTypeNameFactory()->createBoolean();
    }

    public function getPhpTemplate(): string
    {
        return $this->getPhpTemplateOperationOnly();
    }

    public function toPhp($code)
    {
        $ifStructure = $this->getIfStructure();
        $condition = $ifStructure->getCondition();
        $trueExpression = $ifStructure->getTrueExpression();
        $conditionPhp = $condition->toPhp($condition->getCode());
        $trueExpressionPhp = $trueExpression->toPhp($trueExpression->getCode());
        return "(( ($conditionPhp) ? ($trueExpressionPhp) : true ) || true)";
    }
}