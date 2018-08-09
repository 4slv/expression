<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\CalculationException;
use Slov\Expression\Operation\ExponentiationOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class Exponentiation extends ExponentiationOperation implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

    use OperandCode;

    const template = 'exponentiation';

    const templateFolder = 'operation';

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
        if(
            !in_array($firstType,[TypeName::INT(),TypeName::UNKNOWN()]) ||
            !in_array($secondType,[TypeName::INT(),TypeName::UNKNOWN()])
        )
            $this->throwOperationException();
        return $this->render(compact('firstValue', 'secondValue'));
    }

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return TypeName::INT();
    }

}