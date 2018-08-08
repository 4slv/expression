<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class AssignOperation extends \Slov\Expression\Operation\AssignOperation implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

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