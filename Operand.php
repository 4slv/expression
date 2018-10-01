<?php

namespace Slov\Expression;

use Slov\Expression\Type\TypeFactory;
use Slov\Expression\Type\TypeRegExp;
use Slov\Expression\Type\TypeName;

/** Преобразование операнда к php коду */
class Operand implements StringToPhp
{
    use CodeAccessor;

    public function toPhp($code)
    {
        $typeName = $this->getTypeName($code);
        $type = TypeFactory::getInstance()->create($typeName);

        return $type->toPhp($code);
    }

    /**
     * @param string $code псевдо-код операнда
     * @return TypeName
     * @throws ExpressionException
     */
    public function getTypeName($code)
    {
        return TypeRegExp::getTypeNameByStringValue($code);
    }
}