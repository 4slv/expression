<?php

namespace Slov\Expression\Code;

/** Запуск псевдокода */
class CodeExecutor
{
    use CodeAccessor;
    use CodePartFactory;

    /** @var CodeContext контекст кода */
    protected $codeContext;

    /**
     * @return CodeContext контекст кода
     */
    public function getCodeContext(): CodeContext
    {
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

    public function execute(): void
    {
        //$this->createCodeBlock()->setCode($this->getCode())->parse($this->getCodeContext())
    }
}