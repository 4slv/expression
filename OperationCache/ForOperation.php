<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;
use Slov\Helper\StringHelper;

class ForOperation extends \Slov\Expression\Operation\ForOperation implements OperationCache
{

    use PhpValues;

    use SingleTemplate;

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
     * @param string $firstOperandValue
     * @param string $secondOperandValue
     * @param TypeName $firstType
     * @param TypeName $secondType
     * @return string
     */
    protected function generatePhpValues(string $firstOperandValue,string $secondOperandValue, TypeName $firstType,TypeName $secondType)
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