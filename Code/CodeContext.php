<?php

namespace Slov\Expression\Code;

use Slov\Expression\Expression\ExpressionList;
use Slov\Expression\Expression\ExpressionPart;
use Slov\Expression\Expression\ExpressionPartList;
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

    /**
     * @param string $label метка части выражения
     * @return ExpressionPart часть выражения
     * @throws CodeParseException
     */
    public function getExpressionPartByLabel($label)
    {
        if(preg_match('/^(\w+)(\d+)$/', $label,$match)){
            $labelPrefix = $match[1];
            foreach ($this->getExpressionPartListArray() as $expressionPartList)
            {
                if($expressionPartList->getLabelPrefix() === $labelPrefix)
                {
                    return $expressionPartList->get($label);
                }
            }
        }
        throw new CodeParseException($label. ' :: label is not expression part');
    }

    /**
     * @return ExpressionPartList[] массив списков частей выражений
     */
    protected function getExpressionPartListArray()
    {
        return [
            $this->getOperandList(),
            $this->getOperationList(),
            $this->getExpressionList()
        ];
    }

    /**
     * @param string $label метка части выражения
     * @return bool true - метка является частью выражения
     */
    public function checkLabelIsExpressionPart(string $label)
    {
        foreach ($this->getExpressionPartListArray() as $expressionPartList)
        {
            $labelPrefix = $expressionPartList->getLabelPrefix();
            $labelRegexp = "/^$labelPrefix\d+$/";
            if(preg_match($labelRegexp, $label))
            {
                return true;
            }
        }
        return false;
    }
}