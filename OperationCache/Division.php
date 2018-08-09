<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\CalculationException;
use Slov\Expression\Operation\DivisionOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;
use Slov\Expression\Type\TypeName;

class Division extends DivisionOperation implements OperationCache
{
    use PhpValues;

    use MultiplyTemplate;

    use OperandCode;


    const subTemplateFolder = 'div';

    const templateFolder = 'operation';

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        $firstType = $this->getFirstOperandType();
        $secondType = $this->getSecondOperandType();
        switch (true){
            case (
                in_array($firstType ,[ TypeName::INT(),TypeName::FLOAT()])
                && in_array($secondType,[ TypeName::UNKNOWN(),TypeName::FLOAT(), TypeName::INT()])
            ):
                return TypeName::FLOAT();
            case (
                $firstType == TypeName::MONEY()
                && in_array($secondType,[ TypeName::UNKNOWN(),TypeName::FLOAT(), TypeName::INT()])
            ):
                return TypeName::MONEY();
            default:
                return  TypeName::UNKNOWN();

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
    protected function generatePhpValues(string $firstValue, string $secondValue, TypeName $firstType, TypeName $secondType) : string
    {
        switch (true){
            case (
                in_array($firstType ,[ TypeName::INT(),TypeName::FLOAT()])
                && in_array($secondType,[ TypeName::UNKNOWN(),TypeName::FLOAT(), TypeName::INT()])
            ):
                $templateName = 'numeric_numeric';
                break;
            case (
                $firstType == TypeName::MONEY()
                && in_array($secondType,[ TypeName::UNKNOWN(),TypeName::FLOAT(), TypeName::INT()])
            ):
                $templateName = 'money_numeric';
                break;
            default:
                $this->throwOperationException();
        }
        return $this->render(
            $templateName,
            compact('firstValue','secondValue')
        );
    }

}