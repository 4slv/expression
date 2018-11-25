<?php


namespace Slov\Expression\Statement;

use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePartList;

/** Список инструкций */
class StatementList extends CodePartList
{
    const LABEL_PREFIX = 'Statement';

    /** @var Statement[] список инструкций */
    protected $list;

    public function getLabelPrefix(): string
    {
        return self::LABEL_PREFIX;
    }

    /** Добавление элемента в список
     * @param Statement $listElement элемент
     * @param string $elementLabel метка элемента
     * @return string метка элемента */
    public function append($listElement, $elementLabel = null)
    {
        return parent::append($listElement, $elementLabel);
    }

    /** Получение элемента по метке
     * @param string $label метка элемента из списка
     * @return Statement инструкция
     * @throws CodeParseException */
    public function get($label)
    {
        /** @var Statement $result */
        $result = parent::get($label);
        return $result;
    }
}