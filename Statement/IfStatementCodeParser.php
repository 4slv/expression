<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Bracket\BracketType;

/** Разбор псевдокода содержащего условную инструкцию if */
class IfStatementCodeParser extends StatementCodeParser
{
    public function getStatementTypeRegexp(): StatementTypeRegexp
    {
        return StatementTypeRegexp::byValue(StatementTypeRegexp::IF_STATEMENT);
    }

    public function parse(string $code): string
    {
        if(preg_match(
            $this->getStatementTypeRegexp()->getValue(),
            $code,
            $match
        )){
            list($statementCode, $statementCodeBegin) = $match;
            $statementCodeEnd = $this
                ->getBracketParser()
                ->parseFirstGroup(
                    $statementCode,
                    BracketType::byValue(BracketType::BRACES)
                );
            return $statementCodeBegin. $statementCodeEnd;
        }
        $this->throwParseError($code);
    }
}