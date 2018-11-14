<?php

namespace Slov\Expression\Code;

/** Доступ к метке */
trait LabelAccessor
{
    /** @var string метка */
    protected $label;

    /**
     * @return string метка
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label метка
     * @return $this
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }
}