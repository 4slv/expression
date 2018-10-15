<?php

namespace Slov\Expression;

use Slov\Expression\Statement\ComplexStatementList;
use Slov\Expression\Statement\SimpleStatementList;

/** Контекст выполняемого кода */
class CodeContext
{
    /** @var ComplexStatementList список составных инструкций */
    private $complexStatementList;

    /** @var SimpleStatementList список простых инструкций */
    private $simpleStatementList;

    /**
     * @return ComplexStatementList список составных инструкций
     */
    public function getComplexStatementList(): ComplexStatementList
    {
        if(is_null($this->complexStatementList)){
            $this->complexStatementList = new ComplexStatementList();
        }
        return $this->complexStatementList;
    }

    /**
     * @return SimpleStatementList список простых инструкций
     */
    public function getSimpleStatementList(): SimpleStatementList
    {
        if(is_null($this->simpleStatementList)) {
            $this->simpleStatementList = new SimpleStatementList();
        }
        return $this->simpleStatementList;
    }
}