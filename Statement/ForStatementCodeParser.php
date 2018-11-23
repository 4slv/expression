<?php

namespace Slov\Expression\Statement;


use Slov\Expression\Bracket\BracketType;

class ForStatementCodeParser extends StatementCodeParser
{
    public function getStatementTypeRegexp(): StatementTypeRegexp
    {
        return StatementTypeRegexp::byValue(StatementTypeRegexp::FOR_STATEMENT);
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
                    BracketType::byName(BracketType::BRACES)
                );
            return $statementCodeBegin. $statementCodeEnd;
        }
        $this->throwParseError($code);
    }
}