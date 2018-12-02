<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Логическая операция не */
class NotOperation extends Operation
{
    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            $this->getLeftOperandTypeName()->isNull()
            &&
            $this->getRightOperandTypeName()->isBoolean()
        ){
            return $this->getTypeNameFactory()->createBoolean();
        }
        return $this->typeDefinitionFailed();
    }

    public function toPhp(CodeContext $codeContext): string
    {
        if(
            $this->getLeftOperandTypeName()->isNull()
            &&
            $this->getRightOperandTypeName()->isBoolean()
        ){
            $rightOperandPhp = $this
                ->getRightOperand()
                ->getPhp();
            return "!($rightOperandPhp)";
        }
        return parent::toPhp($codeContext);
    }
}