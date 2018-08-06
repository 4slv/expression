<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\TemplateProcessor;
use Slov\Helper\StringHelper;

class ForOperation extends \Slov\Expression\Operation\ForOperation implements OperationCache
{

    use PhpValues;

    const template = 'for';

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
            "%initialization%" => $this->getForStructure()->getFirst()->generatePhpCode(),
            "%condition%" => $this->getForStructure()->getCondition()->generatePhpCode(),
            "%step%" => $this->getForStructure()->getEachStep()->generatePhpCode(),
            "%action%" => $this->getForStructure()->getAction()->generatePhpCode()
        ]);
    }
}