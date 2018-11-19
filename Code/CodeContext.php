<?php

namespace Slov\Expression\Code;

use Slov\Expression\Expression\ExpressionList;
use Slov\Expression\Operation\OperationList;
use Slov\Expression\Statement\SimpleStatementList;
use Slov\Expression\Type\OperandList;


/** Контекст кода */
class CodeContext
{
    /** @var OperandList список операндов */
    protected $operandList;

    /** @var OperationList список операций */
    protected $operationList;

    /** @var ExpressionList список выражений */
    protected $expressionList;

    /** @var SimpleStatementList список простых инструкций */
    protected $simpleStatementList;

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

    /**
     * @return ExpressionList список выражений
     */
    public function getExpressionList(): ExpressionList
    {
        if(is_null($this->expressionList))
        {
            $this->expressionList = new ExpressionList();
        }
        return $this->expressionList;
    }

    /**
     * @return SimpleStatementList список простых инструкций
     */
    public function getSimpleStatementList(): SimpleStatementList
    {
        if(is_null($this->simpleStatementList)){
            $this->simpleStatementList = new SimpleStatementList();
        }
        return $this->simpleStatementList;
    }


}