<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;

/** Фабрика инструкций */
class StatementFactory
{
    /** @var Statement[] список инструкций */
    protected $list;

    /** @var SimpleStatement простая инструкция */
    protected $simpleStatement;

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
}