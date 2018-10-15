<?php

namespace Slov\Expression;

/** Класс для запуска псевдо кода */
class CodeExecutor
{
    use CodeAccessorTrait;

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
            ->setCode($this->getCode())
            ->toStatementList()
            ->toPhp();
        eval($phpCode);
    }
}