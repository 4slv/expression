<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\TemplateProcessor;
use Slov\Helper\StringHelper;

class DateOperation extends \Slov\Expression\Operation\DateOperation  implements OperationCache
{
    use PhpValues;

    const template = 'date';

    const templateFolder = 'operation';

    protected function getTemplate()
    {
        return TemplateProcessor::getInstance()
            ->getTemplateByName(static::template,[static::templateFolder]);
    }

    protected function generatePhpValues($firstOperandValue, $secondOperandValue)
    {
        return StringHelper::replacePatterns(
            $this->getTemplate(),
            [
                "%date%" => $secondOperandValue->format('Y-m-d'),
            ]
        );
    }

}