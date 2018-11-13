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
    protected function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }
}