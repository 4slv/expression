<?php

namespace Slov\Expression\Code;

/** Список частей псевдо кода */
abstract class CodePartList
{
    const LABEL_PREFIX = 'CodePart';

    /** @var CodePart[] список частей псевдо кода */
    protected $list;

    public function __construct()
    {
        $this->list = [];
    }

    abstract public function getLabelPrefix(): string;

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

    /** Получение части псевдо кода
     * @param string $label метка элемента списка
     * @return CodePart часть псевдо кода
     * @throws CodeParseException */
    public function get($label)
    {
        if(array_key_exists($label, $this->list))
        {
            return $this->list[$label];
        }
        throw new CodeParseException(
            $label. ' not found in '. self::class
        );
    }

    /** @return string название новоой метки */
    protected function getNewLabel()
    {
        $size = count($this->list);
        return $this->getLabelPrefix(). $size;
    }

}