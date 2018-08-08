<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class AndOperation extends \Slov\Expression\Operation\AndOperation implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

    const template = 'and';

    const templateFolder = 'operation';


    /**
     * @return string
     */
    public function resolveReturnTypeName(){
        return TypeName::BOOLEAN();
    }

    /**
     * @param string $firstOperand
     * @param string $secondOperand
     * @param TypeName $firstType
     * @param TypeName $secondType
     * @return string
     */
    protected function generatePhpValues(string $firstOperand, string $secondOperand, TypeName $firstType,TypeName $secondType)
    {
        return $this->render(compact('firstOperand', 'secondOperand'));
    }

}