<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePart;
use Slov\Expression\Code\CodePartList;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\TypeNameAccessor;

/** Часть выражения */
abstract class ExpressionPart extends CodePart
{
    use TypeNameAccessor;

    /** Определение типа
     * @param CodeContext $codeContext контекст кода
     * @return TypeName тип
     * @throws CodeParseException */
    abstract protected function typeDefinition(CodeContext $codeContext): TypeName;

    /** разбор кода операнда
     * @param CodeContext $codeContext контекст кода
     * @return $this
     * @throws CodeParseException */
    public function parse(CodeContext $codeContext)
    {
        $typeName = $this->typeDefinition($codeContext);
        $this->setTypeName($typeName);
        /** @var CodePartList $contextList */
        $contextList = $this->getContextList($codeContext);
        $label = $contextList->append($this);
        $this->setLabel($label);
        $php = $this->toPhp($codeContext);
        $this->setPhp($php);
        return $this;
    }
}