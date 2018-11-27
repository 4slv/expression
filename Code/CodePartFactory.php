<?php

namespace Slov\Expression\Code;

use Slov\Expression\Expression\AssignExpression;
use Slov\Expression\Expression\ExpressionWithBrackets;
use Slov\Expression\Expression\ExpressionWithoutBrackets;
use Slov\Expression\Expression\Variable;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\Operand;

/** Фабрика частей кода */
trait CodePartFactory
{
    /**
     * @return CodeBlock блок кода
     */
    protected function createCodeBlock(): CodeBlock
    {
        return new CodeBlock();
    }

    /**
     * @return AssignExpression выражение присваивания
     */
    protected function createAssignExpression(): AssignExpression
    {
        return new AssignExpression();
    }

    /**
     * @return ExpressionWithBrackets выражение со скобками
     */
    protected function createExpressionWithBrackets(): ExpressionWithBrackets
    {
        return new ExpressionWithBrackets();
    }

    /**
     * @return ExpressionWithoutBrackets выражение без скобок
     */
    protected function createExpressionWithoutBrackets(): ExpressionWithoutBrackets
    {
        return new ExpressionWithoutBrackets();
    }

    /**
     * @return Operation операция
     */
    protected function createOperation(): Operation
    {
        return new Operation();
    }

    /**
     * @return Variable переменная
     */
    protected function createVariable(): Variable
    {
        return new Variable();
    }

    /**
     * @return Operand операнд
     */
    protected function createOperand()
    {
        return new Operand();
    }
}