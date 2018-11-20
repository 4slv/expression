<?php

namespace Slov\Expression\Expression;

/** Доступ к флагу использования обрамляющих скобок */
trait UseBracketsAccessor
{
    /** @var bool флаг использования обрамляющих скобок */
    protected $useBrackets = false;

    /**
     * @return bool флаг использования обрамляющих скобок
     */
    public function getUseBrackets(): bool
    {
        return $this->useBrackets;
    }

    /**
     * @param bool $useBrackets флаг использования обрамляющих скобок
     * @return $this
     */
    public function setUseBrackets(bool $useBrackets)
    {
        $this->useBrackets = $useBrackets;
        return $this;
    }
}