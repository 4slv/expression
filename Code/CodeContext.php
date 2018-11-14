<?php

namespace Slov\Expression\Code;

use Slov\Expression\Type\OperandList;

/** Контекст кода */
class CodeContext
{
    /** @var OperandList список операндов */
    protected $operandList;

    /**
     * @return OperandList
     */
    public function getOperandList(): OperandList
    {
        return $this->operandList;
    }

    /**
     * @param OperandList $operandList
     * @return CodeContext
     */
    public function setOperandList(OperandList $operandList): CodeContext
    {
        $this->operandList = $operandList;
        return $this;
    }


}