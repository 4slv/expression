<?php

namespace Slov\Expression;

use Slov\Expression\Statement\StatementList;

/** Преобразователь псевдо кода */
class CodeTransform
{
    use CodeAccessorTrait;

    /**
     * @return StatementList список инструкций
     */
    public function toStatementList()
    {
        $parsedCode = $this
            ->createCodeParser()
            ->parse($this->getCode());
        var_dump($parsedCode);
        die();
    }

    /**
     * @return CodeParser парсер кода
     */
    private function createCodeParser()
    {
        return new CodeParser();
    }
}