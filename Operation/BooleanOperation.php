<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Type\TypeName;

/** Логическая операция */
abstract class BooleanOperation extends Operation
{
    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        if(
            $this->getLeftOperandTypeName()->isBoolean()
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
            $this->getLeftOperandTypeName()->isBoolean()
            &&
            $this->getRightOperandTypeName()->isBoolean()
        ){
            return $this
                ->getOperationToPhpTemplate()
                ->sameCode($this);
        }
        return parent::toPhp($codeContext);
    }
}