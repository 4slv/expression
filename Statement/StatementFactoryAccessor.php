<?php

namespace Slov\Expression\Statement;

/** Доступ к фабрикам инструкций */
trait StatementFactoryAccessor
{
    /** @var ComplexStatementFactory фабрика составных инструкций */
    protected $complexStatementFactory;

    /**
     * @return ComplexStatementFactory фабрика составных инструкций
     */
    public function getComplexStatementFactory(): ComplexStatementFactory
    {
        return
            $this->complexStatementFactory ?? new ComplexStatementFactory();
    }
}