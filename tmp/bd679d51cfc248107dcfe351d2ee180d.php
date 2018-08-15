<?php

class expressionbd679d51cfc248107dcfe351d2ee180d
{
    public static function expressionFunctionbd679d51cfc248107dcfe351d2ee180d($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(Slov\Money\Money::create((((((int)expression450e6656864b57a1b6a2b32093907e9f::expressionFunction450e6656864b57a1b6a2b32093907e9f($functionList,$variableList)->getValue()) * expression6f3c1cbafe501d4bb25979b74f0ad817::expressionFunction6f3c1cbafe501d4bb25979b74f0ad817($functionList,$variableList)->getValue()) * ((((int)1) + expression6f3c1cbafe501d4bb25979b74f0ad817::expressionFunction6f3c1cbafe501d4bb25979b74f0ad817($functionList,$variableList)->getValue()) ** expressionbdd0ca22850c1d55c5e78a3b12964757::expressionFunctionbdd0ca22850c1d55c5e78a3b12964757($functionList,$variableList)->getValue())) / (((((int)1) + expression6f3c1cbafe501d4bb25979b74f0ad817::expressionFunction6f3c1cbafe501d4bb25979b74f0ad817($functionList,$variableList)->getValue()) ** expressionbdd0ca22850c1d55c5e78a3b12964757::expressionFunctionbdd0ca22850c1d55c5e78a3b12964757($functionList,$variableList)->getValue()) - ((int)1)))));
    }

    public static function getType()
    {
     //   return expressionbd679d51cfc248107dcfe351d2ee180d::expressionFunctionbd679d51cfc248107dcfe351d2ee180d()->getType();
        return new Slov\Expression\Type\TypeName('money');
    }
}