<?php

namespace Slov\Expression\Bracket;

use Slov\Expression\Code\CodeParseException;

/** Разбор строки со скобками */
class BracketParser
{
    /** Выделение первой группы скобок с содержимым
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

    /** Выделение содержимого первой группы скобок
     * @param string $code код со скобками
     * @param BracketType $bracketType тип скобок
     * @return string содержимое первой группы скобок
     * @throws CodeParseException
     */
    public function parseFirstGroupContent(string $code, BracketType $bracketType): string
    {
        $firstGroup = $this->parseFirstGroup($code, $bracketType);
        return substr($firstGroup, 1, -1);
    }

    /**
     * Разбиение строки на части с учётом группировки скобок
     * @param string $code строка
     * @param BracketType $bracketType тип скобок
     * @param string $delimiter разделитель
     * @return string[] части строки с корректной вложенностью скобок
     * @throws CodeParseException
     */
    public function split(string $code, BracketType $bracketType, string $delimiter): array
    {
        $result = [];
        $codePartList = explode($delimiter, $code);
        $resultPartList = [];
        $openBracket = $bracketType->getOpenBracket();
        $closeBracket = $bracketType->getCloseBracket();
        foreach ($codePartList as $codePart)
        {
            $resultPartList[] = $codePart;
            $resultPart = implode($delimiter, $resultPartList);
            $openBracketCount = substr_count($resultPart, $openBracket);
            $closeBracketCount = substr_count($resultPart, $closeBracket);
            if($openBracketCount === $closeBracketCount)
            {
                $result[] = $resultPart;
                $resultPartList = [];
            }
        }

        if(implode($delimiter, $result) === $code)
        {
            return $result;
        }
        throw new CodeParseException($code. ' :: bracket parsing error');
    }
}