<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CodeAccessor;
use Slov\Expression\FactoryRepository;
use Slov\Expression\Operand;
use Slov\Expression\StringToPhp;
use Slov\Expression\Type\TypeName;
use Slov\Expression\ExpressionException;

/** Операция с типами */
abstract class Operation implements StringToPhp {

    use CodeAccessor,
        FactoryRepository,
        OperationPhpTemplateTrait,
        OperationToPhpTrait;

    /** @var Operand первый операнд */
    protected $firstOperand;

    /** @var Operand второй операнд */
    protected $secondOperand;

    /**
     * @return TypeName возвращаемый тип
     */
    abstract public function resolveReturnTypeName();

    /**
     * @return string шаблон выражения с операцией
     */
    abstract public function getPhpTemplate(): string;

    /**
     * @return Operand первый операнд
     */
    public function getFirstOperand(): Operand
    {
        return $this->firstOperand;
    }

    /**
     * @return Operand второй операнд
     */
    public function getSecondOperand(): Operand
    {
        return $this->secondOperand;
    }

    /**
     * @return TypeName тип первого операнда
     */
    public function getFirstOperandTypeName(): TypeName
    {
        return $this->getFirstOperand()->getTypeName();
    }

    /**
     * @param Operand $firstOperand первый операнд
     * @return $this;
     */
    public function setFirstOperand(Operand $firstOperand)
    {
        $this->firstOperand = $firstOperand;
        return $this;
    }

    /**
     * @return TypeName тип второго операнда
     */
    public function getSecondOperandTypeName(): TypeName
    {
        return $this->getSecondOperand()->getTypeName();
    }

    /**
     * @param Operand $secondOperand второй операнд
     * @return $this
     */
    public function setSecondOperand(Operand $secondOperand)
    {
        $this->secondOperand = $secondOperand;
        return $this;
    }
}