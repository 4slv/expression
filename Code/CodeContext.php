<?php

namespace Slov\Expression\Code;

use Slov\Expression\Type\OperandList;

/** Контекст кода */
class CodeContext
{
    /** @var OperandList список операндов */
    protected $operandList;

    /**
     * @return OperandList список операндов
     */
    public function getOperandList(): OperandList
    {
        if(is_null($this->operandList)){
            $this->operandList = new OperandList();
        }
        return $this->operandList;
    }


}