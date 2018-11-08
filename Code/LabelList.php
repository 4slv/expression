<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\LabelListException;

/** Список меток */
abstract class LabelList
{
    /** @var array список объектов: метка объекта => объект */
    private $list;

    public function __construct()
    {
        $this->list = [];
    }

    /** @return string префикс метки */
    abstract protected function getLabelPrefix();

    /**
     * @param mixed $element добавляемый элемент к списку
     * @param string $label метка элемента
     * @return string метка элемента
     */
    public function append($element, $label = null)
    {
        $label = $label ?? $this->getLabelPrefix(). count($this->list);
        $this->list[$label] = $element;
        return $label;
    }

    /**
     * @param string $label метка объекта
     * @return mixed объект
     * @throws LabelListException
     */
    public function get($label)
    {
        if($this->exists($label))
        {
            return $this->list[$label];
        }
        throw new LabelListException('Label '. $label. ' not found in LabelList');
    }

    /**
     * @param string $label метка
     * @return bool
     */
    public function exists($label)
    {
        return array_key_exists($label, $this->list);
    }

    /**
     * @return array список объектов
     */
    public function getList(): array
    {
        return $this->list;
    }
}