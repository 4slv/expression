<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Expression;
use Slov\Expression\TextExpression\FunctionStructure;

/** Операция функция */
class FunctionOperation extends Operation
{
    /** @var FunctionStructure структура функции */
    protected $functionStructure;

    /** @var Expression[] список парамтеров */
    protected $functionParameterList;

    /**
     * @return FunctionStructure структура функции
     */
    public function getFunctionStructure(): FunctionStructure
    {
        return $this->functionStructure;
    }

    /**
     * @param FunctionStructure $functionStructure структура функции
     * @return $this
     */
    public function setFunctionStructure(FunctionStructure $functionStructure)
    {
        $this->functionStructure = $functionStructure;
        return $this;
    }

    /**
     * @return Expression[] список парамтеров
     */
    public function getFunctionParameterList(): array
    {
        return $this->functionParameterList;
    }

    /**
     * @param Expression[] $functionParameterList список парамтеров
     * @return $this
     */
    public function setFunctionParameterList(array $functionParameterList)
    {
        $this->functionParameterList = $functionParameterList;
        return $this;
    }

    public function getOperationName()
    {
        return new OperationName(OperationName::FUNCTION);
    }

    protected function createZero(){}

    protected function calculateValues($firstOperandValue, $secondOperandValue){}

    protected function resolveReturnTypeName(){}

    public function calculate()
    {
        $functionStructure = $this->getFunctionStructure();
        $functionParameterList = [];
        foreach($this->getFunctionParameterList() as $functionParameter)
        {
            $functionParameterList[] = $functionParameter->calculate();
        }
        $function = $functionStructure->getFunction();

        return call_user_func_array($function, $functionParameterList);
    }
}