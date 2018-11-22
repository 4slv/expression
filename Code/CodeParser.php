<?php

namespace Slov\Expression\Code;

use Slov\Expression\Statement\StatementType;
use Slov\Expression\Statement\StatementTypePart;
use Slov\Expression\Statement\StatementTypeRegexp;

/** Разбор кода */
class CodeParser
{
    use CodeAccessor;

    public function parse()
    {
        $code = $this->getCode();
        while ($statementRegexp = $this->resolveFirstStatementRegexp($code)){
            if(preg_match($statementRegexp, $code, $match)){
                $statementRegexpCode = $match[0];

            }
        }
    }

    /**
     * регулярное выражение для типа первой инструкции
     * @param string $code псевдокод
     * @return StatementTypeRegexp регулярное выражение для типа инструкции
     */
    protected function resolveFirstStatementRegexp(string $code): StatementTypeRegexp
    {
        $minPosition = INF;
        $resultStatementTypePart = null;
        foreach($this->getStatementTypePartList() as $statementTypePart){
            $position = strpos($code, $statementTypePart->getValue());
            if($position < $minPosition)
            {
                $minPosition = $position;
                $resultStatementTypePart = $statementTypePart;
            }
        }

        return isset($resultStatementTypePart)
            ? StatementTypeRegexp::byName($resultStatementTypePart->getName())
            : null;
    }

    /**
     * @return StatementType[] список частей типов инструкций
     */
    protected function getStatementTypePartList()
    {
        return StatementTypePart::getConstants();
    }

    /**
     * @param string $code псевдокод
     * @param StatementTypeRegexp $statementTypeRegexp регулярное выражение инструкции
     * @return string псевдокод инструкции
     */
    protected function parseStatementCode(string $code, StatementTypeRegexp $statementTypeRegexp): string
    {
        if(preg_match($statementTypeRegexp->getValue(), $code, $match)){
            $regexpCode = $match[0];
            $statementStartCode = $match[1];

        }
    }
}