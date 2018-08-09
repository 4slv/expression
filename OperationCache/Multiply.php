<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\CalculationException;
use Slov\Expression\Operation\MultiplyOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;
use Slov\Expression\Type\TypeName;

class Multiply extends MultiplyOperation implements OperationCache
{


    use PhpValues;

    use MultiplyTemplate;

    use OperandCode;

    const subTemplateFolder = 'multiply';

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
                in_array($firstType,[ TypeName::UNKNOWN(), TypeName::INT()])
                && in_array($secondType,[ TypeName::UNKNOWN(), TypeName::INT()])
            ):
                return TypeName::INT();
            case (
                in_array($firstType,[ TypeName::UNKNOWN(), TypeName::INT(),TypeName::MONEY()])
                && in_array($secondType,[ TypeName::UNKNOWN(), TypeName::INT(),TypeName::MONEY()])
                && (($firstType == TypeName::MONEY()) xor ($secondType  == TypeName::MONEY()))
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
        $templateName = implode('_',[$this->typeToTemplateName($firstType),$this->typeToTemplateName($secondType)]);
        if(!in_array($templateName,['numeric_numeric','numeric_money','money_numeric']))
            $this->throwOperationException();
        return $this->render(
            $templateName,
            compact('firstValue','secondValue')
        );
    }

    /**
     * @param TypeName $type
     * @return string
     * @throws CalculationException
     */
    protected function typeToTemplateName(TypeName $type) : string
    {
        switch ($type){
            case TypeName::INT():
            case TypeName::UNKNOWN():
                return 'numeric';
            case TypeName::MONEY():
                return 'money';
            default:
                $this->throwOperationException();

        }
    }



}