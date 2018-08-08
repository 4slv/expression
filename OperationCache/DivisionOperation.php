<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\CalculationException;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;
use Slov\Expression\Type\TypeName;

class DivisionOperation extends \Slov\Expression\Operation\DivisionOperation implements OperationCache
{
    use PhpValues;

    use MultiplyTemplate;


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
                $firstType == TypeName::INT()
                && in_array($secondType,[ TypeName::UNKNOWN(), TypeName::INT()])
            ):
                return TypeName::INT();
            case (
                $firstType == TypeName::MONEY()
                && in_array($secondType,[ TypeName::UNKNOWN(), TypeName::INT()])
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
                $firstType == TypeName::INT()
                && in_array($secondType,[ TypeName::UNKNOWN(), TypeName::INT()])
            ):
                $templateName = 'numeric_numeric';
                break;
            case (
                $firstType == TypeName::MONEY()
                && in_array($secondType,[ TypeName::UNKNOWN(), TypeName::INT()])
            ):
                $templateName = 'money_numeric';
                break;
            default:
                throw new CalculationException();
        }
        return $this->render(
            $templateName,
            compact('firstValue','secondValue')
        );
    }

}