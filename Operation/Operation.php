<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CodeAccessor;
use Slov\Expression\FactoryRepository;
use Slov\Expression\Operand;
use Slov\Expression\CodeToPhp;
use Slov\Expression\TextExpression\ExpressionList;
use Slov\Expression\Type\TypeName;

/** Операция с типами */
abstract class Operation implements CodeToPhp {

    use CodeAccessor,
        FactoryRepository,
        OperationPhpTemplateTrait,
        OperationToPhpTrait;

    /** @var Operand первый операнд */
    protected $firstOperand;

    /** @var Operand второй операнд */
    protected $secondOperand;

    /** @var ExpressionList список выражений */
    protected $expressionList;

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
     * @return ExpressionList список выражений
     */
    public function getExpressionList(): ExpressionList
    {
        return $this->expressionList;
    }

    /**
     * @param ExpressionList $expressionList список выражений
     * @return $this
     */
    public function setExpressionList(ExpressionList $expressionList)
    {
        $this->expressionList = $expressionList;
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
        return $typeName->getValue() === TypeName::EXPRESSION
            ? $operand
                ->getExpressionList()
                ->get(
                    $operand->getCode()
                )
                ->getOperation()
                ->resolveReturnTypeName()
            : $typeName;
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