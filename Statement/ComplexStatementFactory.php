<?php

namespace Slov\Expression\Statement;

/** Фабрика составной инструкции */
class ComplexStatementFactory
{

    /**
     * @return ComplexStatementFor
     */
    public function createFor()
    {
        return new ComplexStatementFor();
    }

    /**
     * @return ComplexStatementIf
     */
    public function createIf()
    {
        return new ComplexStatementIf();
    }

    public function create(ComplexStatementName $name): ComplexStatement
    {
        switch ($name->getValue())
        {
            case ComplexStatementName::FOR:
                return $this->createFor();
            case ComplexStatementName::IF:
                return $this->createIf();
        }
    }
}