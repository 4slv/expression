<?php

namespace Slov\Expression\Code;

/** Доступ к php-коду */
trait PhpAccessor
{
    /** @var string php код */
    protected $php;

    /** @return string php код */
    public function getPhp()
    {
        return $this->php;
    }

    /** @param string $php php код
     * @return $this */
    public function setPhp($php)
    {
        $this->php = $php;
        return $this;
    }
}