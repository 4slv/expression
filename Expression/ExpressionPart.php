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
    use UseBracketsAccessor;

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
        $label = $contextList->append($this, $this->defineLabel());
        $this->setLabel($label);
        $php = $this->toOriginalPhp($codeContext);
        $this->setPhp($php);
        return $this;
    }

    /** @return null|string метка элемента */
    protected function defineLabel(): ?string
    {
        return null;
    }

    /**
     * @return string получение изначального кода
     */
    public function getOriginalCode(): string
    {
        return $this->getUseBrackets()
            ? '('. $this->getCode(). ')'
            : $this->getCode();
    }

    /**
     * @param CodeContext $codeContext контекст кода
     * @return string получение оригинального php кода (со скобками)
     * @throws CodeParseException
     */
    public function toOriginalPhp(CodeContext $codeContext)
    {
        return $this->getUseBrackets()
            ? '('. $this->toPhp($codeContext). ')'
            : $this->toPhp($codeContext);
    }
}