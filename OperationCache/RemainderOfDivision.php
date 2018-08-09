<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\CalculationException;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class RemainderOfDivision extends \Slov\Expression\Operation\RemainderOfDivisionOperation implements OperationCache
{

    use PhpValues;

    use SingleTemplate;

    use OperandCode;

    const template = 'remainder_of_division';

    const templateFolder = 'operation';

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return TypeName::INT();
    }


    /**
     * @param string $firstValue
     * @param string $secondValue
     * @param TypeName $firstType
     * @param TypeName $secondType
     * @return string
     * @throws CalculationException
     */
    protected function generatePhpValues(string $firstValue, string $secondValue, TypeName $firstType, TypeName $secondType)
    {
        if(in_array($firstType, [TypeName::INT(),TypeName::UNKNOWN()]) && in_array($secondType, [TypeName::INT(),TypeName::UNKNOWN()]))
            return $this->render(compact('firstValue', 'secondValue'));
        $this->throwOperationException();
    }
}