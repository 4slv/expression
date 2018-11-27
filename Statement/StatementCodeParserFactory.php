<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;

/** Фабрика способов разбора псевдокода на код инструкций */
class StatementCodeParserFactory
{
    /**
     * Получение способа разбора псевдокода на инструкцию по типу инструкции
     * @param StatementType $statementType тип инструкции
     * @return StatementCodeParser разбор псевдокода на код инструкции
     * @throws CodeParseException
     */
    public function getElementByType(StatementType $statementType): StatementCodeParser
    {
        switch ($statementType->getValue()){
            case StatementType::SIMPLE_STATEMENT:
                return $this->createSimpleStatementCodeParser();
            case StatementType::IF_STATEMENT:
                return $this->createIfStatementCodeParser();
            case StatementType::FOR_STATEMENT:
                return $this->createForStatementCodeParser();
        }
        throw new CodeParseException($statementType->getValue(). ' :: CodeParser not exists in '. self::class);
    }

    /**
     * @return SimpleStatementCodeParser разбор псевдокода содержащего простую инструкцию
     */
    public function createSimpleStatementCodeParser(): SimpleStatementCodeParser
    {
        return new SimpleStatementCodeParser();
    }

    /**
     * @return IfStatementCodeParser разбор псевдокода содержащего инструкцию if
     */
    public function createIfStatementCodeParser(): IfStatementCodeParser
    {
        return new IfStatementCodeParser();
    }

    /**
     * @return ForStatementCodeParser разбор псевдокода содержащего инструкцию for
     */
    public function createForStatementCodeParser(): ForStatementCodeParser
    {
        return new ForStatementCodeParser();
    }


}