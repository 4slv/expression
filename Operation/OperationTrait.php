<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CalculationException;
use Slov\Expression\Expression;
use Slov\Expression\FactoryRepository;
use Slov\Expression\TextExpression\VariableList;
use Slov\Expression\Type\Type;
use Slov\Expression\Type\TypeInterface;
use Slov\Expression\Type\TypeName;

trait OperationTrait
{
    use FactoryRepository;

    /** @var TypeName тип первого операнда */
    protected $firstOperandTypeName;

    /** @var TypeName тип второго операнда */
    protected $secondOperandTypeName;

    /**
     * @return TypeName тип первого операнда
     */
    public function getFirstOperandTypeName(): TypeName
    {
        return $this->firstOperandTypeName;
    }

    /**
     * @param TypeName $firstOperandTypeName тип первого операнда
     * @return $this;
     */
    public function setFirstOperandTypeName(TypeName $firstOperandTypeName)
    {
        $this->firstOperandTypeName = $firstOperandTypeName;
        return $this;
    }

    /**
     * @return TypeName тип второго операнда
     */
    public function getSecondOperandTypeName(): TypeName
    {
        return $this->secondOperandTypeName;
    }

    /**
     * @param TypeName $secondOperandTypeName тип второго операнда
     * @return $this
     */
    public function setSecondOperandTypeName(TypeName $secondOperandTypeName)
    {
        $this->secondOperandTypeName = $secondOperandTypeName;
        return $this;
    }
}