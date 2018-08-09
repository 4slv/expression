<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\IfElseOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;
use Slov\Expression\Type\TypeName;

class IfElse extends IfElseOperation implements OperationCache
{

    use OperandCode;

    use SingleTemplate;

    const templateFolder = "operation";

    const template = "if_else";

    /**
     * @return string
     */
    public function generatePhpCode()
    {
        $ifElseStructure = $this->getIfElseStructure();
        return $this->render([
            'condition' => $ifElseStructure->getCondition()->generatePhpCode(),
            'trueResult' => $ifElseStructure->getTrueResult()->generatePhpCode(),
            'falseResult' => $ifElseStructure->getFalseResult()->generatePhpCode()
        ]);
    }

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName()
    {
        if($this->getFirstOperandType() == $this->getSecondOperandType())
            return $this->getFirstOperandType();
        return TypeName::UNKNOWN();
    }
}