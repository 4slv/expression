<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\TemplateProcessor\TemplateProcessor;
use Slov\Helper\StringHelper;
use Slov\Money\Money;
use Slov\Expression\OperationCache\Traits\PhpValues;

class MultiplyOperation extends \Slov\Expression\Operation\MultiplyOperation implements OperationCache
{


    use PhpValues;

    const template = 'multiply';

    const templateFolder = 'operation';

    protected function getTemplate($name)
    {
        return TemplateProcessor::getInstance()
            ->getTemplateByName(implode('_',[static::template,$name]),[static::templateFolder]);
    }


    protected function generatePhpValues($firstOperandValue, $secondOperandValue)
    {
        if(is_numeric($firstOperandValue) && is_numeric($secondOperandValue)){
            return StringHelper::replacePatterns(
                $this->getTemplate('numeric'),
                [
                    "%firstOperandValue%" => $firstOperandValue->generatePhpCode(),
                    "%secondOperandValue%" => $secondOperandValue->generatePhpCode()
                ]
            );
        }elseif(
            $firstOperandValue instanceof Money && is_numeric($secondOperandValue)
            ||
            is_numeric($firstOperandValue) && $secondOperandValue instanceof Money
        ){
            return StringHelper::replacePatterns(
                $this->getTemplate('money'),
                [
                    "%firstOperandValue%" => ($firstOperandValue instanceof Money ? $firstOperandValue->getAmount() : $firstOperandValue),
                    "%secondOperandValue%" => ($secondOperandValue instanceof Money ? $secondOperandValue->getAmount() : $secondOperandValue)
                ]
            );
        }
        return null;
    }



}