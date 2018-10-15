<?php

namespace Slov\Expression\Statement;

use Slov\Expression\ToPhpTransformer;

/** Список инструкций */
class StatementList implements ToPhpTransformer
{
    /**
     * @var Statement[] список инструкций
     */
    private $statementList;

    /**
     * @return Statement[] список инструкций
     */
    public function getStatementList(): array
    {
        return $this->statementList;
    }

    /**
     * @param Statement[] $statementList список инструкций
     * @return $this
     */
    public function setStatementList(array $statementList)
    {
        $this->statementList = $statementList;
        return $this;
    }
    
    public function toPhp(): string
    {
        $php = '';
        foreach ($this->getStatementList() as $statement)
        {
            $php .= $statement->toPhp();
        }
        return $php;
    }
}