<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\TemplateProcessor\TemplateProcessor;
use Slov\Helper\StringHelper;

class FunctionOperation extends \Slov\Expression\Operation\FunctionOperation implements OperationCache
{


    const template = 'function';

    const templateFolder = 'operation';

    /**
     * @return bool|string
     */
    protected function getTemplate()
    {
        return TemplateProcessor::getInstance()
        ->getTemplateByName(static::template,[static::templateFolder]);
    }

    public function generatePhpCode()
    {
        $functionStructure = $this->getFunctionStructure();
        $functionParameterList = array_map(function($functionParameter){
            return $functionParameter->generatePhpCode();
        },$this->getFunctionParameterList());
        return StringHelper::replacePatterns(
            $this->getTemplate(),
            [
                '%name%' => $functionStructure->getName(),
                "%params%" => implode(', ',$functionParameterList)
            ]
        );
    }


}