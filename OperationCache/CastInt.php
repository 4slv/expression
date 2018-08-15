<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\IntOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class CastInt extends IntOperation implements OperationCache
{

    use MultiplyTemplate;

    use OperandCode;

    const subTemplateFolder = "int";

    const templateFolder = "operation";

    /**
     * @return string
     */
    public function generatePhpCode()
    {
        if($this->getSecondOperandType() == TypeName::MONEY())
            return $this->render('money',['secondValue' => $this->getSecondOperandCode()]);
        return $this->render('numeric',['secondValue' => $this->getSecondOperandCode()]);
    }

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        return TypeName::INT();
    }

}