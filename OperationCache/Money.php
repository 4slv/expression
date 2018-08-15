<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\MoneyOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class Money extends MoneyOperation implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

    use OperandCode;

    const template = "money";

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
        return TypeName::MONEY();
    }

}