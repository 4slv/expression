<?php

namespace Slov\Expression\Functions;

/** Доступ к списку пользовательских функций */
trait UserFunctionListAccessor
{
    /** @var FunctionList список пользовательских функций */
    protected $userFunctionList;

    /**
     * @return FunctionList список пользовательских функций
     */
    public function getUserFunctionList(): FunctionList
    {
        return $this->userFunctionList;
    }

    /**
     * @param FunctionList $userFunctionList список пользовательских функций
     * @return $this
     */
    public function setUserFunctionList(FunctionList $userFunctionList)
    {
        $this->userFunctionList = $userFunctionList;
        return $this;
    }
}