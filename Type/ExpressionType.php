<?php

namespace Slov\Expression\Type;


use Slov\Expression\TextExpression\ExpressionContextAccessor;

class ExpressionType extends Type
{
    use ExpressionContextAccessor;

    /** @var TypeName тип переменной */
    private $typeName;

    /**
     * @return TypeName тип переменной
     */
    public function getTypeName(): TypeName
    {
        return $this->typeName;
    }

    /**
     * @param TypeName $typeName тип переменной
     * @return $this
     */
    public function setTypeName(TypeName $typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }

    public function toPhp($code)
    {
        return $this
            ->getExpressionList()
            ->get($code)
            ->toPhp($code);
    }
}