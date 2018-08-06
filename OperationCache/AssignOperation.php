<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\TemplateProcessor;
use Slov\Helper\StringHelper;

class AssignOperation extends \Slov\Expression\Operation\AssignOperation implements OperationCache
{
    use PhpValues;


    const template = 'assign';

    const templateFolder = 'operation';

    protected function getTemplate()
    {
        return TemplateProcessor::getInstance()
            ->getTemplateByName(static::template,[static::templateFolder]);
    }

    public function generatePhpCode()
    {
        return StringHelper::replacePatterns(
            $this->getTemplate(),
            [
                '%variable%' => $this->getVariableName(),
                '%value%'=>$this->secondOperand->generatePhpCode()
            ]
        );
    }

}