<?php

namespace Slov\Expression\Type;

use MabeEnum\Enum;
use Slov\Expression\Code\CodeParseException;

/** Регулярное выражение описывающее тип */
class TypeRegExp extends Enum
{
    const FUNCTION = '(\((\w+)\)\s*([a-z]\w*))(\(.*\))';
    const DATE_TIME = '(\d{4}\.\d{2}\.\d{2})( \d{2}\:\d{2}\:\d{2})?(\.\d{6})?';
    const DATE_INTERVAL = '(\d+)\s?(day|days)';
    const INT = '\d+';
    const FLOAT = '\d+\.\d+';
    const BOOLEAN = '(true|false)';
    const VARIABLE = '\$([a-z][\w\d]*)';
    const MONEY = '(\d+)?\$(\d{2})?';

    /**
     * @param string $typeStringValue строковое представление типа
     * @return TypeName название типа
     * @throws CodeParseException
     */
    public static function getTypeNameByStringValue($typeStringValue)
    {
        foreach(self::getConstants() as $typeKey => $typeRegExp)
        {
            if(preg_match('/^'. $typeRegExp. '$/i', $typeStringValue))
            {
                $typeName = constant(TypeName::class. '::'. $typeKey);
                return TypeName::byValue($typeName);
            }
        }
        throw new CodeParseException($typeStringValue. ' :: unknown type of value');
    }
}