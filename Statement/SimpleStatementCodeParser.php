<?php

namespace Slov\Expression\Statement;

/** Разбор псевдокода содержащего простую инструкцию */
class SimpleStatementCodeParser extends StatementCodeParser
{

    public function getStatementTypeRegexp(): StatementTypeRegexp
    {
        return StatementTypeRegexp::byValue(StatementTypeRegexp::SIMPLE_STATEMENT);
    }

    public function parse(string $code): string
    {
        if(preg_match($this->getStatementTypeRegexp()->getValue(), $code, $match)){
            return $match[0];
        }
        $this->throwParseError($code);
    }
}