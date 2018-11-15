<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Type\Operand;

/** Строитель операций */
class OperationBuilder
{
    /** @var Operation операция */
    protected $operation;

    /** @var OperationName название операции */
    protected $operationName;

    /** @var string псевдо код операции */
    protected $operationCode;

    /** @var string псевдо код левого операнда */
    protected $leftOperandCode;

    /** @var string псевдо код знака операции */
    protected $operationSignCode;

    /** @var string псевдо код правого операнда */
    protected $rightOperandCode;

    /**
     * @return Operation операция
     */
    public function getOperation(): Operation
    {
        return $this->operation;
    }

    /**
     * @param Operation $operation операция
     * @return OperationBuilder
     */
    protected function setOperation(Operation $operation): OperationBuilder
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return OperationName название операции
     */
    public function getOperationName(): OperationName
    {
        return $this->operationName;
    }

    /**
     * @param OperationName $operationName название операции
     * @return OperationBuilder
     */
    public function setOperationName(OperationName $operationName): OperationBuilder
    {
        $this->operationName = $operationName;
        return $this;
    }

    /**
     * @return string псевдо код операции
     */
    public function getOperationCode(): string
    {
        return $this->operationCode;
    }

    /**
     * @param string $operationCode псевдо код операции
     * @return OperationBuilder
     */
    public function setOperationCode(string $operationCode): OperationBuilder
    {
        $this->operationCode = $operationCode;
        return $this;
    }

    /**
     * @return string псевдо код левого операнда
     */
    public function getLeftOperandCode(): string
    {
        return $this->leftOperandCode;
    }

    /**
     * @param string $leftOperandCode псевдо код левого операнда
     * @return OperationBuilder
     */
    public function setLeftOperandCode(string $leftOperandCode): OperationBuilder
    {
        $this->leftOperandCode = $leftOperandCode;
        return $this;
    }

    /**
     * @return string псевдо код знака операции
     */
    public function getOperationSignCode(): string
    {
        return $this->operationSignCode;
    }

    /**
     * @param string $operationSignCode псевдо код знака операции
     * @return OperationBuilder
     */
    public function setOperationSignCode(string $operationSignCode): OperationBuilder
    {
        $this->operationSignCode = $operationSignCode;
        return $this;
    }

    /**
     * @return string псевдо код правого операнда
     */
    public function getRightOperandCode(): string
    {
        return $this->rightOperandCode;
    }

    /**
     * @param string $rightOperandCode псевдо код правого операнда
     * @return OperationBuilder
     */
    public function setRightOperandCode(string $rightOperandCode): OperationBuilder
    {
        $this->rightOperandCode = $rightOperandCode;
        return $this;
    }

    /**
     * @return OperationFactory фабрика операций
     */
    public function getOperationFactory(): OperationFactory
    {
        return OperationFactory::getInstance();
    }

    /** Создание операнда
     * @param string $operandCode псевдо код операнда
     * @param CodeContext $codeContext контекст кода
     * @return Operand операнд
     * @throws CodeParseException */
    public function createOperand(string $operandCode, CodeContext $codeContext): Operand
    {
        $operand = new Operand();
        return $operand
            ->setCode($operandCode)
            ->parse($codeContext);
    }

    /**
     * @param CodeContext $codeContext
     * @return $this
     * @throws CodeParseException
     */
    public function build(CodeContext $codeContext)
    {
        $operation = $this->getOperationFactory()->create($this->getOperationName());
        $leftOperand = $this->createOperand($this->getLeftOperandCode(), $codeContext);
        $rightOperand = $this->createOperand($this->getRightOperandCode(), $codeContext);
        $operation
            ->setCode($this->getOperationCode())
            ->setLeftOperand($leftOperand)
            ->setRightOperand($rightOperand);
        $this->setOperation($operation);
        return $this;
    }


}