<?php

namespace Slov\Expression\Bracket;

/** Доступ к разбору скобок */
trait BracketParserAccessor
{
    /** @var BracketParser разбор скобок */
    protected $bracketParser;

    /**
     * @return BracketParser разбор скобок
     */
    public function getBracketParser(): BracketParser
    {
        if(is_null($this->bracketParser)){
            $this->bracketParser = new BracketParser();
        }
        return $this->bracketParser;
    }
}