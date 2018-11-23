<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePart;

/** Инструкция */
abstract class Statement extends CodePart
{
    /** Инициализация инструкции
     *  @param CodeContext $codeContext контекст кода
     * @throws CodeParseException */
    abstract protected function initStatement(CodeContext $codeContext): void;

    public function parse(CodeContext $codeContext)
    {
        $this->initStatement($codeContext);
        return parent::parse($codeContext);
    }
}