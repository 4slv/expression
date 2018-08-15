<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\DateOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class Date extends DateOperation  implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

    use OperandCode;

    const template = 'date';

    const templateFolder = 'operation';

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return TypeName::DATE_TIME();
    }

    /**
     * @param string $firstOperandValue
     * @param string $secondOperandValue
     * @param TypeName $firstType
     * @param TypeName $secondType
     * @return string
     */
    protected function generatePhpValues(string $firstOperandValue,string $secondOperandValue,TypeName $firstType,TypeName $secondType)
    {
        return $this->render(
            [
                "date_time" => $secondOperandValue,
            ]
        );
    }

}