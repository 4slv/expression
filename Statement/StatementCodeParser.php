<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;

/** Разбор псевдокода инструкции */
abstract class StatementCodeParser
{
    /**
     * @return StatementTypeRegexp регулярное выражение для типа инструкции
     */
    abstract protected function getStatementTypeRegexp(): StatementTypeRegexp;

    /**
     * @param string $code псевдокод
     * @return string псевдокод инструкции
     * @throws CodeParseException
     */
    abstract function parse(string $code): string;

    /**
     * @param string $code псевдокод
     * @throws CodeParseException
     */
    protected function throwParseError(string $code)
    {
        $statementTypeRegexpName = $this->getStatementTypeRegexp()->getName();
        $statementTypeName = StatementType::byName($statementTypeRegexpName);
        throw new CodeParseException($code. ' :: code is not '. $statementTypeName);
    }
}