<?php

namespace Slov\Expression\Statement;


class StatementCodeParserRegistry
{
    /** @var StatementCodeParser[] список способов рабора псевдокода на код инструкций */
    protected $list;

    /** @var SimpleStatementCodeParser разбор псевдокода содержащего простую инструкцию */
    protected $simpleStatementCodeParser;

    /** @var IfStatementCodeParser разбор псевдокода содержащего инструкцию if */
    protected $ifStatementCodeParser;

    /** @var ForStatementCodeParser разбор псевдокода содержащего инструкцию for */
    protected $forStatementCodeParser;

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

    /**
     * @return StatementCodeParser[] список способов рабора псевдокода на код инструкций
     */
    public function getList(): array
    {
        if(is_null($this->list))
        {
            $this->list = [
                $this->getSimpleStatementCodeParser(),
                $this->getIfStatementCodeParser(),
                $this->getForStatementCodeParser()
            ];
        }
        return $this->list;
    }


}