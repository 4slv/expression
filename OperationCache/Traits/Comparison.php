<?php


namespace Slov\Expression\OperationCache\Traits;


use Slov\Expression\CalculationException;
use Slov\Expression\Type\TypeName;

trait Comparison
{

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return TypeName::BOOLEAN();
    }

    /**
     * @param string $firstValue
     * @param string $secondValue
     * @param TypeName $firstType
     * @param TypeName $secondType
     * @return string
     * @throws CalculationException
     */
    protected function generatePhpValues(string $firstValue, string $secondValue, TypeName $firstType, TypeName $secondType) : string
    {
        switch (true){
            case ($firstType == TypeName::INT() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::INT()):
            case ($firstType == TypeName::INT() && $secondType  == TypeName::INT()):
            case ($firstType == TypeName::FLOAT() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::FLOAT()):
            case ($firstType == TypeName::FLOAT() && $secondType  == TypeName::FLOAT()):
            case ($firstType == TypeName::INT() && $secondType  == TypeName::FLOAT()):
            case ($firstType == TypeName::FLOAT() && $secondType  == TypeName::INT()):
                $templateName = 'numeric_numeric';
                break;
            case ($firstType == TypeName::MONEY() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::MONEY()):
            case ($firstType == TypeName::MONEY() && $secondType  == TypeName::MONEY()):
                $templateName = 'money_money';
                break;
            case ($firstType == TypeName::DATE_INTERVAL() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::DATE_INTERVAL()):
            case ($firstType == TypeName::DATE_INTERVAL() && $secondType  == TypeName::DATE_INTERVAL()):
                $templateName = 'date_interval_date_interval';
                break;
            case ($firstType == TypeName::DATE_TIME() && $secondType  == TypeName::UNKNOWN()):
            case ($firstType == TypeName::UNKNOWN() && $secondType  == TypeName::DATE_TIME()):
            case ($firstType == TypeName::DATE_TIME() && $secondType  == TypeName::DATE_TIME()):
                $templateName = 'date_time_date_time';
                break;
            default:
                $this->throwOperationException();

        }
        return $this->render($templateName, compact('firstValue','secondValue'));

    }

}