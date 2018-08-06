<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traites\Templater;
use Slov\Helper\StringHelper;

class FunctionOperation extends \Slov\Expression\Operation\FunctionOperation implements OperationCache
{
    use Templater;

    const template = 'function.txt';

    public function generatePhpCode()
    {
        $functionStructure = $this->getFunctionStructure();
        $functionParameterList = [];
        foreach($this->getFunctionParameterList() as $functionParameter)
        {
            $functionParameterList[] = $functionParameter->calculate();
        }
        $function = $functionStructure->getFunction();

        RETURN StringHelper::replacePatterns($this->getTemplate(), []);
        return call_user_func_array($function, $functionParameterList);
    }


}