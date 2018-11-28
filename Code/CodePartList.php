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

    /** Получение элемента списка по метке
     * @param string $label метка элемента списка
     * @return CodePart элемент списка
     * @throws CodeParseException */
    public function get($label)
    {
        if($this->exists($label))
        {
            return $this->list[$label];
        }
        throw new CodeParseException(
            $label. ' not found in '. self::class
        );
    }

    /** Проверка существования элемента с указанной меткой
     * @param string $label метка элемента списка
     * @return bool
     */
    public function exists($label): bool
    {
        return array_key_exists($label, $this->list);
    }

    /**
     * @return CodePart[] список элементов
     */
    public function getList(): array
    {
        return $this->list;
    }

    /** @return string название новоой метки */
    protected function getNewLabel()
    {
        $size = count($this->list);
        return $this->getLabelPrefix(). $size;
    }

}