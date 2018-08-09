<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\IntOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class CastInt extends IntOperation implements OperationCache
{

    use SingleTemplate;

    use OperandCode;

    const template = "int";

    const templateFolder = "operation";

    /**
     * @return string
     */
    public function generatePhpCode()
    {
        return $this->render(['secondValue' => $this->getSecondOperandCode()]);
    }

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return TypeName::INT();
    }

}