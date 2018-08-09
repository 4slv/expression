<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\CalculationException;
use Slov\Expression\Operation\DaysInYearOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class DaysInYear extends DaysInYearOperation implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

    use OperandCode;

    const template = 'days_in_year';

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
        if( in_array($secondType, [TypeName::DATE_TIME(),TypeName::UNKNOWN()]))
            return $this->render(compact('secondValue'));
        $this->throwOperationException();
    }
}