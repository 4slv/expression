<?php

namespace Slov\Expression\Type;

use MyCLabs\Enum\Enum;
use Slov\Expression\ExpressionException;

/** Регулярное выражение описывающее тип */
class TypeRegExp extends Enum
{
    const DATE_TIME = '\d{4}\.\d{2}\.\d{2}( \d{2}\:\d{2}\:\d{2})?';
    const DATE_INTERVAL = '(\d+)\s?(day|days)';
    const INT = '\d+';
    const FLOAT = '\d+\.\d+';
    const EXPRESSION = '_Expression\d*';
    const NULL = '';
    const MONEY = '(\d+)?\$(\d{2})?';
    const VARIABLE = '\$([a-zA-Z][\w\d]*)';
    const FUNCTION = '\$([a-zA-Z][\w\d]*)\[([^\[\]]+)\]';
    const STRING = "[^']*";

    /**
     * @param string $typeStringValue строковое представление типа
     * @return TypeName название типа
     * @throws ExpressionException
     */
    public static function getTypeNameByStringValue($typeStringValue)
    {
        foreach(self::values() as $typeKey => $typeRegExp)
        {
            if(preg_match('/^'. $typeRegExp. '$/', $typeStringValue))
            {
                $typeName = constant(TypeName::class. '::'. $typeKey);
                return new TypeName($typeName);
            }
        }
        throw new ExpressionException('Unknown type of value: "'. $typeStringValue. '"');
    }
}