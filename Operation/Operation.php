<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Expression\ExpressionPart;
use Slov\Expression\Type\Operand;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\TypeNameFactoryAccessor;

/** Операция */
class Operation extends ExpressionPart
{
    use TypeNameFactoryAccessor;

    /** @var Operation операция */
    protected $operation;

    /** @var Operand левый операнд */
    protected $leftOperand;

    /** @var Operand правый операнд */
    protected $rightOperand;

    /**
     * @return Operation операция
     */
    public function getOperation(): Operation
    {
        return $this->operation;
    }

    /**
     * @param Operation $operation операция
     * @return Operation
     */
    public function setOperation(Operation $operation): Operation
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return Operand левый операнд
     */
    public function getLeftOperand(): Operand
    {
        return $this->leftOperand;
    }

    /**
     * @param Operand $leftOperand левый операнд
     * @return $this
     */
    public function setLeftOperand(Operand $leftOperand)
    {
        $this->leftOperand = $leftOperand;
        return $this;
    }

    /**
     * @return Operand правый операнд
     */
    public function getRightOperand(): Operand
    {
        return $this->rightOperand;
    }

    /**
     * @param Operand $rightOperand правый операнд
     * @return $this
     */
    public function setRightOperand(Operand $rightOperand)
    {
        $this->rightOperand = $rightOperand;
        return $this;
    }

    /**
     * @return TypeName тип левого операнда
     */
    public function getLeftOperandTypeName()
    {
        return $this->getLeftOperand()->getTypeName();
    }

    /**
     * @return TypeName тип левого операнда
     */
    public function getRightOperandTypeName()
    {
        return $this->getRightOperand()->getTypeName();
    }

    /**
     * @return OperationToPhpTemplate
     */
    protected function getOperationToPhpTemplate()
    {
        return new OperationToPhpTemplate();
    }

    public function parse(CodeContext $codeContext)
    {
        $operation = $this
            ->createOperationResolver()
            ->resolve($this->getCode(), $codeContext);
        $this->setOperation($operation);
        $operation->parseOperationParts($codeContext);
        return parent::parse($codeContext);
    }

    /**
     * Разбор частей операции
     * @param CodeContext $codeContext контекст операции
     * @throws CodeParseException
     */
    protected function parseOperationParts(CodeContext $codeContext): void
    {
    }

    protected function createOperationResolver()
    {
        return new OperationResolver();
    }

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        return $this->operation->typeDefinition($codeContext);
    }

    /**
     * @throws CodeParseException
     */
    protected function typeDefinitionFailed()
    {
        throw new CodeParseException($this->getOperation()->getCode(). ' :: type definition failed');
    }

    public function toPhp(CodeContext $codeContext): string
    {
        return $this->operation->toPhp($codeContext);
    }

    /**
     * @throws CodeParseException
     */
    protected function codeToPhpFailed()
    {
        throw new CodeParseException($this->getOperation()->getCode(). ' :: code to php failed');
    }

    /**
     * @param CodeContext $codeContext контекст кода
     * @return OperationList список операций
     */
    protected function getContextList(CodeContext $codeContext)
    {
        return $codeContext->getOperationList();
    }

    /**
     * @return string знак операции
     * @throws CodeParseException
     */
    public function getSign(): string
    {
        throw new CodeParseException($this->getCode(). ' :: operation has no sign');
    }
}