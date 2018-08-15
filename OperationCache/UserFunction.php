<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\ExpressionCache;
use Slov\Expression\Operation\FunctionOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\VariableType;

class UserFunction extends FunctionOperation implements OperationCache
{

    use OperandCode;

    use MultiplyTemplate;

    const subTemplateFolder = 'function';

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
            if($functionParameter instanceof VariableType)
                return $this->render('variable_param', ['variable' => $functionParameter->generatePhpCodeForFunction()]);
            return $this->render('param',[
                'param' => $functionParameter->generatePhpCode(),
                'type' => $functionParameter->getType()->getValue()
            ] );
        },$this->getFunctionParameterList());
        return $this->render(
            'function',
            [
                'name' => $functionStructure->getName(),
                "params" => implode(', ',$functionParameterList)
            ]
        );
    }


}