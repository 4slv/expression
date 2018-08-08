<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\CalculationException;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;
use Slov\Expression\Type\TypeName;

class SubtractionOperation extends \Slov\Expression\Operation\SubtractionOperation implements OperationCache
{
    use PhpValues;

    use MultiplyTemplate;

    const subTemplateFolder = 'sub';

    const templateFolder = 'operation';

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        $firstType = $this->getFirstOperandType();
        $secondType = $this->getSecondOperandType();
        switch (true) {
            case ($firstType == TypeName::INT() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::INT()):
            case ($firstType == TypeName::INT() && $secondType  == TypeName::INT()):
                return TypeName::INT();
            case ($firstType == TypeName::MONEY() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::MONEY()):
            case ($firstType == TypeName::MONEY() && $secondType  == TypeName::MONEY()):
                return TypeName::MONEY();
            case ($firstType == TypeName::DATE_INTERVAL() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::DATE_INTERVAL() && $secondType  == TypeName::DATE_INTERVAL()):
                return TypeName::DATE_INTERVAL();
            case ($firstType == TypeName::DATE_TIME() && $secondType == TypeName::DATE_INTERVAL()):
                return TypeName::DATE_TIME();
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::DATE_TIME()):
            case ($firstType == TypeName::DATE_TIME() && $secondType == TypeName::DATE_TIME()):
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
        switch (true){
            case ($firstType == TypeName::INT() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::INT()):
            case ($firstType == TypeName::INT() && $secondType  == TypeName::INT()):
                $templateName = 'numeric_numeric';
                break;
            case ($firstType == TypeName::MONEY() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::MONEY()):
            case ($firstType == TypeName::MONEY() && $secondType  == TypeName::MONEY()):
                $templateName = 'money_money';
                break;
            case ($firstType == TypeName::DATE_INTERVAL() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::DATE_INTERVAL() && $secondType  == TypeName::DATE_INTERVAL()):
                $templateName = 'date_interval_date_interval';
                break;
            case ($firstType == TypeName::DATE_TIME() && $secondType  == TypeName::DATE_INTERVAL()):
                $templateName = 'date_time_date_interval';
                break;
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::DATE_TIME()):
            case ($firstType == TypeName::DATE_TIME() && $secondType  == TypeName::DATE_TIME()):
                $templateName = 'date_time_date_time';
                break;
            default:
                throw new CalculationException();

        }
        return $this->render($templateName, compact('firstValue','secondValue'));
    }

}