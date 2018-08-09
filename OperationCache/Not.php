<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\NotOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class Not extends NotOperation implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

    use OperandCode;

    const template = 'not';

    const templateFolder = 'operation';

    /**
     * @return string
     */
    public function resolveReturnTypeName(){
        return TypeName::BOOLEAN();
    }

    /**
     * @param string $firstValue
     * @param string $secondValue
     * @param TypeName $firstType
     * @param TypeName $secondType
     * @return string
     */
    protected function generatePhpValues(string $firstValue, string $secondValue, TypeName $firstType, TypeName $secondType)
    {
        return $this->render(compact('secondValue'));
    }
}