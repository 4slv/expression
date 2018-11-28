<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeParseException;

/** Список переменных */
class VariableList extends ExpressionPartList
{
    const LABEL_PREFIX = '$';

    /** @var Variable[] список переменных */
    protected $list;

    public function getLabelPrefix(): string
    {
        return self::LABEL_PREFIX;
    }

    /** Добавление элемента в список
     * @param Variable $listElement элемент списка
     * @param string $elementLabel метка элемента списка
     * @return string метка добавленного элемента */
    public function append($listElement, $elementLabel = null)
    {
        return parent::append($listElement, $elementLabel);
    }

    /** Получение элемента по метке
     * @param string $label метка элемента списка
     * @return Variable элемент списка
     * @throws CodeParseException */
    public function get($label)
    {
        /** @var Variable $result */
        $result = parent::get($label);
        return $result;
    }

    /**
     * @return Variable[] список элементов
     */
    public function getList(): array
    {
        return $this->list;
    }
}