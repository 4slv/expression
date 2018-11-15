<?php

namespace Slov\Expression\Code;

use Slov\Expression\Operation\OperationList;
use Slov\Expression\Type\OperandList;

/** Контекст кода */
class CodeContext
{
    /** @var OperandList список операндов */
    protected $operandList;

    /** @var OperationList список операций */
    protected $operationList;

    /** @return OperandList список операндов */
    public function getOperandList(): OperandList
    {
        if(is_null($this->operandList)){
            $this->operandList = new OperandList();
        }
        return $this->operandList;
    }

    /** @return OperationList список операций */
    public function getOperationList(): OperationList
    {
        if(is_null($this->operationList)){
            $this->operationList = new OperationList();
        }
        return $this->operationList;
    }
}