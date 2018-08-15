<?php

class expression5a52dafc92328b7e85bed4162d028a2b
{
    public static function expressionFunction5a52dafc92328b7e85bed4162d028a2b($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(Slov\Money\Money::create(((((((int)expression02656b9c408af9e232a83c64f52b7953::expressionFunction02656b9c408af9e232a83c64f52b7953($functionList,$variableList)->getValue()->getAmount()) * expressionfdd8c018880102beb98007478746db2b::expressionFunctionfdd8c018880102beb98007478746db2b($functionList,$variableList)->getValue()) * expression3d30582e5b6ebaa2c0984bf0ee67a24e::expressionFunction3d30582e5b6ebaa2c0984bf0ee67a24e($functionList,$variableList)->getValue()) / expression1701c4e1294f6f9433048e648767b9ce::expressionFunction1701c4e1294f6f9433048e648767b9ce($functionList,$variableList)->getValue()) + (((((int)expression02656b9c408af9e232a83c64f52b7953::expressionFunction02656b9c408af9e232a83c64f52b7953($functionList,$variableList)->getValue()->getAmount()) * expressionfdd8c018880102beb98007478746db2b::expressionFunctionfdd8c018880102beb98007478746db2b($functionList,$variableList)->getValue()) * expression9b4e99c6ff6303e6749a1929eddf1199::expressionFunction9b4e99c6ff6303e6749a1929eddf1199($functionList,$variableList)->getValue()) / expression3efb4c966c98e81f6094a8332429e0d3::expressionFunction3efb4c966c98e81f6094a8332429e0d3($functionList,$variableList)->getValue()))));
    }

    public static function getType()
    {
     //   return expression5a52dafc92328b7e85bed4162d028a2b::expressionFunction5a52dafc92328b7e85bed4162d028a2b()->getType();
        return new Slov\Expression\Type\TypeName('money');
    }
}