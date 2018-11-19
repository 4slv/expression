<?php


namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePartList;

/** Список простых инструкций */
class SimpleStatementList extends CodePartList
{
    const LABEL_PREFIX = 'SimpleStatement';

    /** @var SimpleStatement[] список простых инструкций */
    protected $list;

    public function getLabelPrefix(): string
    {
        return self::LABEL_PREFIX;
    }

    /** Добавление простой инструкции в список
     * @param SimpleStatement $listElement элемент
     * @param string $elementLabel метка элемента
     * @return string метка элемента */
    public function append($listElement, $elementLabel = null)
    {
        return parent::append($listElement, $elementLabel);
    }

    /** Получение простой инструкции по метке
     * @param string $label метка элемента из списка
     * @return SimpleStatement простая инструкция
     * @throws CodeParseException */
    public function get($label)
    {
        /** @var SimpleStatement $result */
        $result = parent::get($label);
        return $result;
    }
}