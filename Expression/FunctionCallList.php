<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePartList;

/** Список вызовов функций */
class FunctionCallList extends CodePartList
{
    const LABEL_PREFIX = 'FunctionCall';

    public function getLabelPrefix(): string
    {
        return self::LABEL_PREFIX;
    }

    /** Добавление элемента в список
     * @param FunctionCall $listElement элемент списка
     * @param string $elementLabel метка элемента списка
     * @return string метка добавленного элемента */
    public function append($listElement, $elementLabel = null)
    {
        return parent::append($listElement, $elementLabel);
    }

    /** Получение элемента по метке
     * @param string $label метка элемента списка
     * @return FunctionCall элемент списка
     * @throws CodeParseException */
    public function get($label)
    {
        /** @var FunctionCall $result */
        $result = parent::get($label);
        return $result;
    }

    /**
     * @return FunctionCall[] список элементов
     */
    public function getList(): array
    {
        return $this->list;
    }
}