<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class DateOperation extends \Slov\Expression\Operation\DateOperation  implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

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