<?php

namespace Slov\Expression;

trait CodeAccessor
{
    /** @var string псевдо-код */
    private $code;

    /**
     * @return string псевдо-код
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code псевдо-код
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = $code;
        return $this;
    }
}