<?php

namespace Slov\Expression\Code;

use Slov\Expression\Expression\ExpressionList;
use Slov\Expression\Expression\ExpressionPart;
use Slov\Expression\Expression\ExpressionPartList;
use Slov\Expression\Expression\FunctionCallList;
use Slov\Expression\Expression\VariableList;
use Slov\Expression\Operation\OperationList;
use Slov\Expression\Statement\StatementList;
use Slov\Expression\Type\OperandList;


/** Контекст кода */
class CodeContext
{
    /** @var OperandList список операндов */
    protected $operandList;

    /** @var VariableList список переменных */
    protected $variableList;

    /** @var FunctionCallList список вызовов функций */
    protected $functionCallList;

    /** @var OperationList список операций */
    protected $operationList;

    /** @var ExpressionList список выражений */
    protected $expressionList;

    /** @var CodeBlockList список блоков кода */
    protected $codeBlockList;

    /** @var StatementList список инструкций */
    protected $statementList;

    /** @return OperandList список операндов */
    public function getOperandList(): OperandList
    {
        if(is_null($this->operandList)){
            $this->operandList = new OperandList();
        }
        return $this->operandList;
    }

    /**
     * @return VariableList список переменных
     */
    public function getVariableList(): VariableList
    {
        if(is_null($this->variableList))
        {
            $this->variableList = new VariableList();
        }
        return $this->variableList;
    }

    /**
     * @return FunctionCallList список вызовов функций
     */
    public function getFunctionCallList(): FunctionCallList
    {
        if(is_null($this->functionCallList))
        {
            $this->functionCallList = new FunctionCallList();
        }
        return $this->functionCallList;
    }

    /**
     * @return OperationList список операций
     */
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
     * @return CodeBlockList список блоков кода
     */
    public function getCodeBlockList(): CodeBlockList
    {
        if(is_null($this->codeBlockList))
        {
            $this->codeBlockList = new CodeBlockList();
        }
        return $this->codeBlockList;
    }

    /**
     * @return StatementList список инструкций
     */
    public function getStatementList(): StatementList
    {
        if(is_null($this->statementList)){
            $this->statementList = new StatementList();
        }
        return $this->statementList;
    }

    /**
     * @param string $label метка части выражения
     * @return ExpressionPart часть выражения
     * @throws CodeParseException
     */
    public function getExpressionPartByLabel($label)
    {
        if(preg_match('/^(\w+?)(\d+)$/msi', $label,$match)){
            $labelPrefix = $match[1];
            foreach ($this->getExpressionPartListArray() as $expressionPartList)
            {
                if($expressionPartList->getLabelPrefix() === $labelPrefix)
                {
                    return $expressionPartList->get($label);
                }
            }
        }
        if($this->getVariableList()->exists($label))
        {
            return $this->getVariableList()->get($label);
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
            $this->getFunctionCallList(),
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
        return $this->getVariableList()->exists($label);
    }
}