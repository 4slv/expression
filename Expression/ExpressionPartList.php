<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePartList;

/** Список частей выражений */
abstract class ExpressionPartList extends CodePartList
{
    /** @var ExpressionPart[] список частей выражений */
    protected $list;

    /** Добавление элемента в список
     * @param ExpressionPart $listElement элемент списка
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
     * @return ExpressionPart элемент списка
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
}