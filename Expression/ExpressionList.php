<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePartList;

class ExpressionList extends CodePartList
{
    const LABEL_PREFIX = 'Expression';

    public function getLabelPrefix(): string
    {
        return self::LABEL_PREFIX;
    }

    /** Добавление элемента в список
     * @param Expression $listElement элемент списка
     * @param string $elementLabel метка элемента списка
     * @return string метка добавленного элемента */
    public function append($listElement, $elementLabel = null)
    {
        return parent::append($listElement, $elementLabel);
    }

    /** Получение элемента по метке
     * @param string $label метка элемента списка
     * @return Expression элемент списка
     * @throws CodeParseException */
    public function get($label)
    {
        /** @var Expression $result */
        $result = parent::get($label);
        return $result;
    }
}