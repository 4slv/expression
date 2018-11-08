<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Code\LabelListException;

class SimpleStatementList extends LabelList
{
    const LABEL_PREFIX = 'SimpleStatement';

    protected function getLabelPrefix()
    {
        return self::LABEL_PREFIX;
    }

    /** @param string $label
     * @return SimpleStatement
     * @throws LabelListException */
    public function get($label)
    {
        /** @var SimpleStatement $statement */
        $statement = parent::get($label);
        return $statement;
    }

    /**
     * @return SimpleStatement[] список простых инструкций
     */
    public function getList(): array
    {
        return parent::getList();
    }
}