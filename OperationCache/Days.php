<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\CalculationException;
use Slov\Expression\Operation\DaysOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;
use Slov\Expression\Type\TypeName;

class Days extends DaysOperation implements OperationCache
{
    use PhpValues;

    use MultiplyTemplate;

    use OperandCode;

    const subTemplateFolder = 'days';

    const templateFolder = 'operation';

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        $secondType = $this->getSecondOperandType();
        switch ($secondType){
            case TypeName::DATE_INTERVAL():
                return TypeName::INT();
            case TypeName::INT():
            case TypeName::UNKNOWN():
                return TypeName::DATE_INTERVAL();
            default:
                return TypeName::UNKNOWN();
        }
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
        switch ($secondType){
            case TypeName::DATE_INTERVAL():
                $templateName = 'date_interval';
                break;
            case TypeName::INT():
            case TypeName::UNKNOWN():
                $templateName = 'int';
                break;
            default:
                $this->throwOperationException();
        }
        return $this->render($templateName,compact('secondValue'));
    }

}