<?php

namespace Slov\Expression\Statement;

/** Доступ к сборщикам инструкций */
trait StatementBuilderAccessor
{
    /** @var ComplexStatementBuilder фабрика составных инструкций */
    protected $complexStatementBuilder;

    /** @var SimpleStatementBuilder фабрика простых инструкций */
    protected $simpleStatementBuilder;

    /**
     * @return ComplexStatementBuilder фабрика составных инструкций
     */
    public function getComplexStatementBuilder(): ComplexStatementBuilder
    {
        return $this->complexStatementBuilder ?? new ComplexStatementBuilder();
    }

    /**
     * @return SimpleStatementBuilder фабрика простых инструкций
     */
    public function getSimpleStatementBuilder(): SimpleStatementBuilder
    {
        return $this->simpleStatementBuilder ?? new SimpleStatementBuilder();
    }
}