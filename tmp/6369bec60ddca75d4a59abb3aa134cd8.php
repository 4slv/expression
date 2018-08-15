<?php

class expression6369bec60ddca75d4a59abb3aa134cd8
{
    public static function expressionFunction6369bec60ddca75d4a59abb3aa134cd8($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(expressionbac6573c8ad90f5bfc9e04ab0cfa3f1c::expressionFunctionbac6573c8ad90f5bfc9e04ab0cfa3f1c($functionList,$variableList)->getValue()->sub(expression9c6cd5b3fc6f9410a694cdf57df834b3::expressionFunction9c6cd5b3fc6f9410a694cdf57df834b3($functionList,$variableList)->getValue()));
    }

    public static function getType()
    {
     //   return expression6369bec60ddca75d4a59abb3aa134cd8::expressionFunction6369bec60ddca75d4a59abb3aa134cd8()->getType();
        return new Slov\Expression\Type\TypeName('money');
    }
}