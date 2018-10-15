<?php

namespace Slov\Expression;

use Slov\Expression\Statement\ComplexStatementList;
use Slov\Expression\Statement\SimpleStatementList;

/** Доступ к контексту кода */
trait CodeContextAccessor
{
    /** @var CodeContext контекст кода */
    protected $codeContext;

    /**
     * @return CodeContext контекст кода
     */
    public function getCodeContext(): CodeContext
    {
        if(is_null($this->codeContext)){
            $this->codeContext = new CodeContext();
        }
        return $this->codeContext;
    }

    /**
     * @param CodeContext $codeContext контекст кода
     * @return $this
     */
    public function setCodeContext(CodeContext $codeContext)
    {
        $this->codeContext = $codeContext;
        return $this;
    }

    /**
     * @return ComplexStatementList список составных инструкций
     */
    public function getComplexStatementList()
    {
        return $this
            ->getCodeContext()
            ->getComplexStatementList();
    }

    /** @return string получение свободной метки составной инструкции */
    public function getComplexStatementFreeLabel()
    {
        return $this
            ->getComplexStatementList()
            ->getFreeLabel();
    }

    /**
     * @return SimpleStatementList список простых инструкций
     */
    public function getSimpleStatementList()
    {
        return $this
            ->getCodeContext()
            ->getSimpleStatementList();
    }

    /** @return string получение свободной метки простой инструкции */
    public function getSimpleStatementFreeLabel()
    {
        return $this
            ->getSimpleStatementList()
            ->getFreeLabel();
    }
}