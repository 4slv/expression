<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\LabelListException;
use Slov\Expression\Statement\LabelList;

/** Список выражений */
class ExpressionList extends LabelList
{
    const LABEL_PREFIX = 'Expression';

    protected function getLabelPrefix()
    {
        return self::LABEL_PREFIX;
    }

    /**
     * @param Expression $element выражение
     * @param string $label метка элемента
     * @return string метка элемента
     */
    public function append($element, $label = null)
    {
        return parent::append($element, $label);
    }

    /** @param string $label
     * @return Expression
     * @throws LabelListException */
    public function get($label)
    {
        /** @var Expression $label */
        $statement = parent::get($label);
        return $statement;
    }

    /** @return Expression[] список выражений */
    public function getList(): array
    {
        return parent::getList();
    }
}