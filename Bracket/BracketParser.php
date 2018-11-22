<?php

namespace Slov\Expression\Bracket;

/** Разбор строки со скобками */
class BracketParser
{
    /** Выделение первой группы скобок
     * @param string $code код со скобками
     * @param BracketType $bracketType тип скобок
     * @return string код первой скобки с содержимым */
    public function parseFirstGroup(string $code, BracketType $bracketType): string
    {
        $openBracket = $bracketType->getOpenBracket();
        $closeBracket = $bracketType->getCloseBracket();
        $openBracketBeginOffset = strpos($code, $openBracket);
        $closeBracketOffset = $openBracketBeginOffset;
        while ($closeBracketOffset !== false){
            $closeBracketOffset = strpos($code, $closeBracket, $closeBracketOffset);
            $openBracketCount = substr_count(
                $code,
                $openBracket,
                $openBracketBeginOffset,
                $closeBracketOffset - $openBracketBeginOffset
            );
        }
    }
}