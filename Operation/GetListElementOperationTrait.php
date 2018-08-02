<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Expression;

/** Операция получения элемента списка */
trait GetListElementOperationTrait
{
    /** @var Expression[] список парамтеров */
    protected $parameterList;

    /**
     * @return Expression[] список парамтеров
     */
    public function getParameterList(): array
    {
        return $this->parameterList;
    }

    /**
     * @param Expression[] $parameterList список парамтеров
     * @return $this
     */
    public function setParameterList(array $parameterList)
    {
        $this->parameterList = $parameterList;
        return $this;
    }

    /** Получение элемента списка
     * @param array $list
     * @return mixed */
    abstract protected function getListElement(array $list);

    protected function createZero(){}

    protected function calculateValues($firstOperandValue, $secondOperandValue){}

    protected function resolveReturnTypeName(){}

    public function calculate()
    {
        $parameterList = [];
        $parameterValuesList = [];
        foreach($this->getParameterList() as $functionParameter)
        {
            $parameter = $functionParameter->calculate();
            $parameterValue = $parameter->getValue();
            $parameterList[] = $parameter;
            $parameterValuesList[] = $parameterValue;
        }
        $position = array_pop(
            array_keys(
                $parameterValuesList,
                $this->getListElement($parameterValuesList)
            )
        );

        return $parameterList[$position];
    }
}