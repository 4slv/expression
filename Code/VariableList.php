<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\LabelListException;
use Slov\Expression\Statement\LabelList;

/** Список переменных */
class VariableList extends LabelList
{
    const LABEL_PREFIX = 'Variable';

    protected function getLabelPrefix()
    {
        return self::LABEL_PREFIX;
    }

    /** @param string $label название переменной
     * @return VariableStructure
     * @throws LabelListException */
    public function get($label)
    {
        /** @var VariableStructure $label */
        $statement = parent::get($label);
        return $statement;
    }

    /** @return VariableStructure[] список переменных */
    public function getList(): array
    {
        return parent::getList();
    }
}