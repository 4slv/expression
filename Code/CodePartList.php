<?php

namespace Slov\Expression\Code;

/** Список частей псевдо кода */
abstract class CodePartList
{
    const LABEL_PREFIX = 'CodePart';

    /** @var CodePart[] список частей псевдо кода */
    protected $list;

    abstract function getLabelPrefix(): string;

    /** Добавление элемента в список
     * @param CodePart $listElement элемент списка
     * @param string $elementLabel метка элемента списка
     * @return string метка добавленного элемента */
    public function append($listElement, $elementLabel = null)
    {
        $label = $elementLabel ?? $this->getNewLabel();
        $this->list[$label] = $listElement;
        return $label;
    }

    /** @return string название новоой метки */
    protected function getNewLabel()
    {
        $size = count($this->list);
        return $this->getLabelPrefix(). $size;
    }

}