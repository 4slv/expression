<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;

/** Фабрика инструкций */
class StatementFactory
{
    /**
     * Получение инструкции по типу инструкции
     * @param StatementType $statementType тип инструкции
     * @return Statement инструкция
     * @throws CodeParseException
     */
    public function getElementByType(StatementType $statementType): Statement
    {
        switch ($statementType->getValue())
        {
            case StatementType::SIMPLE_STATEMENT:
                return $this->createSimpleStatement();
            case StatementType::IF_STATEMENT:
                return $this->createIfStatement();
            case StatementType::FOR_STATEMENT:
                return $this->createForStatement();
            default:
                throw new CodeParseException(
                    $statementType->getValue().
                    ' not exists in '.
                    self::class
                );
        }
    }

    /**
     * @return SimpleStatement простая инструкция
     */
    public function createSimpleStatement(): SimpleStatement
    {
        return new SimpleStatement();
    }

    /**
     * @return IfStatement условная инструкция
     */
    public function createIfStatement(): IfStatement
    {
        return new IfStatement();
    }

    /**
     * @return ForStatement цикл for
     */
    public function createForStatement(): ForStatement
    {
        return new ForStatement();
    }
}