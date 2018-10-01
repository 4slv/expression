<?php

namespace Slov\Expression;

use Slov\Expression\Type\TypeFactory;
use Slov\Expression\Type\TypeRegExp;
use Slov\Expression\Type\TypeName;

/** Операнд */
class Operand implements StringToPhp
{
    use CodeAccessor;

    /** @var TypeName  */
    protected $typeName;

    /**
     * @param string $code псевдо код
     * @return string php код
     * @throws ExpressionException
     */
    public function toPhp($code)
    {
        $typeName = $this->getTypeName($code);
        $type = TypeFactory::getInstance()->create($typeName);

        return $type->toPhp($code);
    }

    /**
     * @param string|null $code псевдо-код операнда
     * @return TypeName
     * @throws ExpressionException
     */
    public function getTypeName($code = null)
    {
        return $this->typeName ?? TypeRegExp::getTypeNameByStringValue($code ?? $this->getCode());
    }
}