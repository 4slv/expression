<?php

namespace Slov\Expression\Operation;


use Slov\Expression\CodeAccessorTrait;
use Slov\Expression\FactoryRepository;
use Slov\Expression\Operand;
use Slov\Expression\CodeContextAccessor;
use Slov\Expression\ToPhpTransformer;
use Slov\Expression\Type\TypeName;

/** Операция с типами */
abstract class Operation implements ToPhpTransformer {

    use CodeAccessorTrait,
        FactoryRepository,
        OperationPhpTemplateTrait,
        OperationToPhpTrait,
        CodeContextAccessor;

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
        return
            $this->getOperandTypeName(
                $this->getFirstOperand()
            );
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
        return
            $this->getOperandTypeName(
                $this->getSecondOperand()
            );
    }

    /** Определение типа операнда
     * @param Operand $operand операнд
     * @return TypeName тип
     */
    private function getOperandTypeName(Operand $operand): TypeName
    {
        $typeName = $operand->getTypeName();
        switch ($typeName->getValue()){
            case TypeName::EXPRESSION:
                return $operand
                    ->getExpressionList()
                    ->get(
                        $operand->getCode()
                    )
                    ->getOperation()
                    ->resolveReturnTypeName();
            case TypeName::VARIABLE:
                return $operand
                    ->getVariableList()
                    ->get(
                        $operand->getVariableName($operand->getCode())
                    )
                    ->getTypeName();
            default:
                return $operand->getSimpleTypeName();
        }
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