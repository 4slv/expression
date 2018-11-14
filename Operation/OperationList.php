<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePartList;

/** Список операций */
class OperationList extends CodePartList
{
    const LABEL_PREFIX = 'Operation';

    /** @var Operation[] список операций */
    protected $list;

    public function getLabelPrefix(): string
    {
        return self::LABEL_PREFIX;
    }

    /** Добавление операции в список
     * @param Operation $listElement элемент
     * @param string $elementLabel метка элемента
     * @return string метка элемента */
    public function append($listElement, $elementLabel = null)
    {
        return parent::append($listElement, $elementLabel);
    }

    /** Получение операции по метке
     * @param string $label метка элемента из списка
     * @return Operation операция
     * @throws CodeParseException */
    public function get($label)
    {
        /** @var Operation $result */
        $result = parent::get($label);
        return $result;
    }
}