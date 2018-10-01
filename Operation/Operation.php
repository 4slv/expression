<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CodeAccessor;
use Slov\Expression\StringToPhp;
use Slov\Expression\Type\TypeName;

/** Операция с типами */
abstract class Operation implements StringToPhp {

    use CodeAccessor;

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

    /** @return string шаблон выражения на php */
    abstract public function getPhpTemplate(): string;

    /** @return TypeName название типа */
    abstract protected function resolveReturnTypeName();
}