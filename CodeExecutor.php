<?php

namespace Slov\Expression;

/** Класс для запуска псевдо кода */
class CodeExecutor
{
    use CodeAccessorTrait,
        CodeContextAccessor;

    /**
     * @return CodeTransform парсер псевдо кода
     */
    protected function createCodeTransform()
    {
        return new CodeTransform();
    }

    public function execute()
    {
        $phpCode = $this
            ->createCodeTransform()
            ->toPhp($this->getCode(), $this->getCodeContext());

        echo $phpCode;

        eval($phpCode);
    }
}