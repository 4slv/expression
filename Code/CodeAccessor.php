<?php

namespace Slov\Expression\Code;

/** Доступ к псевдо коду */
trait CodeAccessor
{
    /** @var string псевдо код */
    protected $code;

    /** @return string псевдо код */
    public function getCode(): string
    {
        return $this->code;
    }

    /** @param string $code псевдо код
     * @return $this */
    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }

    /** @return string псевдо код без пробелов по краям */
    public function getCodeTrim(): string
    {
        return trim($this->getCode());
    }
}