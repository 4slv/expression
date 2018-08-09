<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\FunctionOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class UserFunction extends FunctionOperation implements OperationCache
{

    use OperandCode;

    use SingleTemplate;

    const template = 'function';

    const templateFolder = 'operation';

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return $this->getFunctionStructure()->getReturnType();
    }

    /**
     * @return string
     */
    public function generatePhpCode()
    {
        $functionStructure = $this->getFunctionStructure();
        $functionParameterList = array_map(function($functionParameter){
            return $functionParameter->generatePhpCode();
        },$this->getFunctionParameterList());
        return $this->render(
            [
                'name' => $functionStructure->getName(),
                "params" => implode(', ',$functionParameterList)
            ]
        );
    }


}