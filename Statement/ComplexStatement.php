<?php

namespace Slov\Expression\Statement;

/** Составная инструкция */
abstract class ComplexStatement extends Statement
{
    /** @var string[] код частей составной инструкции */
    private $codeParts;

    /**
     * @return string[] код частей составной инструкции
     */
    public function getCodeParts(): array
    {
        return $this->codeParts;
    }

    /**
     * @param string[] $codeParts код частей составной инструкции
     * @return $this
     */
    public function setCodeParts(array $codeParts)
    {
        $this->codeParts = $codeParts;
        return $this;
    }

    /** Разбор кода частей и инициализация составной инструкции
     * @return $this
     */
    abstract public function parseParts();
}