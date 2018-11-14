<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Expression\ExpressionPart;

/** Операция */
class Operation extends ExpressionPart
{
    /** разбор кода операции
     * @param CodeContext $codeContext контекст кода
     * @return $this
     * @throws CodeParseException */
    public function parse(CodeContext $codeContext)
    {
        $typeName = $this->typeDefinition($codeContext);
        $this->setTypeName($typeName);
        $contextList = $this->getContextList($codeContext);
        $label = $contextList->append($this);
        $this->setLabel($label);
        $php = $this->toPhp($codeContext);
        $this->setPhp($php);
        return $this;
    }
}