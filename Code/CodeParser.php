<?php

namespace Slov\Expression;

use Slov\Expression\Statement\SimpleStatement;
use Slov\Expression\Statement\Statement;

/** Парсер псевдо кода */
class CodeParser
{
    /** @param string $code псевдо код
     * @return Statement[]
     */
    public function parse($code)
    {
        $statementList = [];
        $statementCodeList = explode(';', $code);
        foreach($statementCodeList as $statementCode){
            if(isset($statementCode)){
                $statementList[] = $this->createSimpleStatement($statementCode);
            }
        }
        return $statementList;
    }

    /**
     * @param string $code псевдо код операции
     * @return SimpleStatement
     */
    private function createSimpleStatement($code)
    {
        $simpleStatement = new SimpleStatement();
        return $simpleStatement
            ->setCode($code);
    }
}