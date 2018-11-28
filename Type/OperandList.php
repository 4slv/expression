<?php

namespace Slov\Expression\Type;


use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Expression\ExpressionPartList;

class OperandList extends ExpressionPartList
{
    const LABEL_PREFIX = 'Operand';

    /** @var Operand[] список операндов */
    protected $list;

    public function getLabelPrefix(): string
    {
        return self::LABEL_PREFIX;
    }

    /** Добавление операнда в список
     * @param Operand $listElement операнд
     * @param string $elementLabel метка элемента
     * @return string метка элемента */
    public function append($listElement, $elementLabel = null)
    {
        return parent::append($listElement, $elementLabel);
    }

    /** Получение операнда по метке
     * @param string $label метка элемента из списка
     * @return Operand операнд
     * @throws CodeParseException
     */
    public function get($label)
    {
        /** @var Operand $result */
        $result = parent::get($label);
        return $result;
    }

    /**
     * @return Operand[] список элементов
     */
    public function getList(): array
    {
        return $this->list;
    }
}