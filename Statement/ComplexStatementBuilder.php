<?php

namespace Slov\Expression\Statement;


class ComplexStatementBuilder
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

    /**
     * @param $statementName
     * @param $statementParts
     */
    public function build($statementName, $statementParts)
    {
        $this
            ->getComplexStatementFactory()
            ->create()
    }
}