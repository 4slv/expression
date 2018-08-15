<?php

class expression1701c4e1294f6f9433048e648767b9ce
{
    public static function expressionFunction1701c4e1294f6f9433048e648767b9ce($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((expression9adb0450bba2f9e15025887816650a59::expressionFunction9adb0450bba2f9e15025887816650a59($functionList,$variableList)->getValue()->format('L') == '1' ? 366 : 365 ));
    }

    public static function getType()
    {
     //   return expression1701c4e1294f6f9433048e648767b9ce::expressionFunction1701c4e1294f6f9433048e648767b9ce()->getType();
        return new Slov\Expression\Type\TypeName('int');
    }
}