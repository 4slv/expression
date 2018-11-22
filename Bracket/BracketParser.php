<?php

namespace Slov\Expression\Bracket;

use Slov\Expression\Code\CodeParseException;

/** Разбор строки со скобками */
class BracketParser
{
    /** Выделение первой группы скобок
     * @param string $code код со скобками
     * @param BracketType $bracketType тип скобок
     * @return string код первой скобки с содержимым
     * @throws CodeParseException
     */
    public function parseFirstGroup(string $code, BracketType $bracketType): string
    {
        $openBracket = $bracketType->getOpenBracket();
        $closeBracket = $bracketType->getCloseBracket();
        $openBracketBeginOffset = strpos($code, $openBracket);
        $closeBracketOffset = $openBracketBeginOffset;
        $codeLastSymbolOffset = strlen($code) - 1;
        $length = 0;
        while (
            $closeBracketOffset !== false
            &&
            $closeBracketOffset <= $codeLastSymbolOffset
        ){
            $closeBracketOffset = strpos($code, $closeBracket, $closeBracketOffset + 1);
            $length = $closeBracketOffset - $openBracketBeginOffset + 1;
            $openBracketCount = substr_count($code, $openBracket, $openBracketBeginOffset, $length);
            $closeBracketCount = substr_count($code, $closeBracket, $openBracketBeginOffset, $length);
            if($openBracketCount === $closeBracketCount)
            {
                break;
            }
        }
        if($length > 0){
            return substr($code, $openBracketBeginOffset, $length);
        }
        throw new CodeParseException($code. ' :: bracket parsing error');
    }
}