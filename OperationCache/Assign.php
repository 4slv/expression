<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\AssignOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class Assign extends AssignOperation implements OperationCache
{
    use SingleTemplate;

    use OperandCode;

    const template = 'assign';

    const templateFolder = 'operation';

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return $this->secondOperand->getType();
    }

    /**
     * @return string
     */
    public function generatePhpCode()
    {
        return $this->render(
            [
                'variable' => $this->getVariableName(),
                'value'=>$this->secondOperand->generatePhpCode(),
            ]
        );
    }

}