<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\ForOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class CycleFor extends ForOperation implements OperationCache
{

    use SingleTemplate;

    use OperandCode;

    const template = 'for';

    const templateFolder = 'operation';

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return TypeName::BOOLEAN();
    }

    /**
     * @return string
     */
    public function generatePhpCode()
    {
        return $this->render(
            [
            "initialization" => $this->getForStructure()->getFirst()->generatePhpCode(),
            "condition" => $this->getForStructure()->getCondition()->generatePhpCode(),
            "step" => $this->getForStructure()->getEachStep()->generatePhpCode(),
            "action" => $this->getForStructure()->getAction()->generatePhpCode()
        ]);
    }
}