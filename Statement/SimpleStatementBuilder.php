<?php

namespace Slov\Expression\Statement;

/** Построитель простой инструкции */
class SimpleStatementBuilder
{
    /**
     * @return SimpleStatement простая инструкция
     */
    public function createSimpleStatement(): SimpleStatement
    {
        return new SimpleStatement();
    }

    /**
     * @param string $simpleStatementCode псевдо код простой инструкции
     * @return SimpleStatement простая инструкция
     */
    public function build($simpleStatementCode): SimpleStatement
    {
        return $this
            ->createSimpleStatement()
            ->setCode($simpleStatementCode);
    }
}