<?php

namespace Slov\Expression\Statement;

/** Построитель составной инструкции */
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
     * @param ComplexStatementName $statementName название составной инструкции
     * @param string[] $statementParts части составной инструкции
     * @return ComplexStatement
     */
    public function build($statementName, $statementParts): ComplexStatement
    {
        $complexStatement = $this
            ->getComplexStatementFactory()
            ->create($statementName);
        $complexStatement
            ->setCode($statementParts[0])
            ->setCodeParts(array_slice($statementParts, 1))
            ->parseParts();
        return $complexStatement;
    }
}