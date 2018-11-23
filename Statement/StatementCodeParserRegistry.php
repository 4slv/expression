<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;

/** Реестр способов разбора псевдокода на код инструкций */
class StatementCodeParserRegistry
{
    /** @var StatementCodeParser[] список способов разбора псевдокода на код инструкций */
    protected $list;

    /** @var SimpleStatementCodeParser разбор псевдокода содержащего простую инструкцию */
    protected $simpleStatementCodeParser;

    /** @var IfStatementCodeParser разбор псевдокода содержащего инструкцию if */
    protected $ifStatementCodeParser;

    /** @var ForStatementCodeParser разбор псевдокода содержащего инструкцию for */
    protected $forStatementCodeParser;

    /**
     * @return StatementCodeParser[] список способов разбора псевдокода на код инструкций
     */
    public function getList(): array
    {
        if(is_null($this->list))
        {
            $this->list = [
                StatementType::SIMPLE_STATEMENT => $this->getSimpleStatementCodeParser(),
                StatementType::IF_STATEMENT => $this->getIfStatementCodeParser(),
                StatementType::FOR_STATEMENT => $this->getForStatementCodeParser()
            ];
        }
        return $this->list;
    }

    /**
     * Получение способа разбора псевдокода на инструкцию по типу инструкции
     * @param StatementType $statementType тип инструкции
     * @return StatementCodeParser разбор псевдокода на код инструкции
     * @throws CodeParseException
     */
    public function getElementByType(StatementType $statementType): StatementCodeParser
    {
        $list = $this->getList();
        if(array_key_exists($statementType->getValue(), $list)){
            return $list[$statementType->getValue()];
        }
        throw new CodeParseException($statementType->getValue(). 'CodeParser not exists in '. self::class);
    }

    /**
     * @return SimpleStatementCodeParser разбор псевдокода содержащего простую инструкцию
     */
    public function getSimpleStatementCodeParser(): SimpleStatementCodeParser
    {
        if(is_null($this->simpleStatementCodeParser)){
            $this->simpleStatementCodeParser = new SimpleStatementCodeParser();
        }
        return $this->simpleStatementCodeParser;
    }

    /**
     * @return IfStatementCodeParser разбор псевдокода содержащего инструкцию if
     */
    public function getIfStatementCodeParser(): IfStatementCodeParser
    {
        if(is_null($this->ifStatementCodeParser))
        {
            $this->ifStatementCodeParser = new IfStatementCodeParser();
        }
        return $this->ifStatementCodeParser;
    }

    /**
     * @return ForStatementCodeParser разбор псевдокода содержащего инструкцию for
     */
    public function getForStatementCodeParser(): ForStatementCodeParser
    {
        if(is_null($this->forStatementCodeParser))
        {
            $this->forStatementCodeParser = new ForStatementCodeParser();
        }
        return $this->forStatementCodeParser;
    }


}