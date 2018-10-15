<?php

namespace Slov\Expression;

/** Доступ к псевдо коду */
trait CodeAccessorTrait
{
    /** @var string псевдо код */
    protected $code;

    /** @var string разорбранный псевдо код */
    protected $codeParsed;

    /**
     * @return string псевдо код
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code псевдо код
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string разобранный псевдо код
     */
    public function getCodeParsed(): string
    {
        return $this->codeParsed;
    }

    /**
     * @param string $codeParsed разобранный псевдо код
     * @return $this
     */
    public function setCodeParsed(string $codeParsed)
    {
        $this->codeParsed = $codeParsed;
        return $this;
    }
}