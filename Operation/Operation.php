<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CodeAccessor;
use Slov\Expression\Expression;
use Slov\Expression\FactoryRepository;
use Slov\Expression\StringToPhp;
use Slov\Expression\Type\TypeName;

/** Операция с типами */
abstract class Operation implements StringToPhp {

    use CodeAccessor;
    use FactoryRepository;

    /** @var TypeName тип первого операнда */
    protected $firstOperandTypeName;

    /** @var TypeName тип второго операнда */
    protected $secondOperandTypeName;

    /**
     * @return TypeName возвращаемый тип
     */
    abstract public function resolveReturnTypeName();

    /**
     * @return string шаблон выражения с операцией
     */
    abstract public function getPhpTemplate(): string;

    protected function getPhpTemplatePrimitive(): string
    {
        return implode(
            ' ',
            [
                Expression::FIRST_OPERAND,
                Expression::OPERATION,
                Expression::SECOND_OPERAND
            ]
        );
    }

    /**
     * @return string шаблон операции с объектами
     */
    protected function getPhpTemplateObject()
    {
        return
            Expression::FIRST_OPERAND.
            '->'. Expression::OPERATION.
            '('. Expression::SECOND_OPERAND. ')';
    }

    /**
     * @return string инвертированный шаблон операции с объектами
     */
    protected function getPhpTemplateObjectInverse(): string
    {
        return Expression::SECOND_OPERAND.
            '->'. Expression::OPERATION.
            '('.Expression::FIRST_OPERAND . ')';
    }

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