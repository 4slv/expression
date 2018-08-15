<?php

class expressionbfc62c0290ccd546030cfd427970e959
{
    public static function expressionFunctionbfc62c0290ccd546030cfd427970e959($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((expression9af1c83316bb9e209a49360d1a3d6869::expressionFunction9af1c83316bb9e209a49360d1a3d6869($functionList,$variableList)->getValue())->add((new DateInterval("P".(expressionc1bec5c3dc5d3ce9ef4ef8bb30245514::expressionFunctionc1bec5c3dc5d3ce9ef4ef8bb30245514($functionList,$variableList)->getValue() * $variableList->get('periodNumber')->getValue())."D"))));
    }

    public static function getType()
    {
     //   return expressionbfc62c0290ccd546030cfd427970e959::expressionFunctionbfc62c0290ccd546030cfd427970e959()->getType();
        return new Slov\Expression\Type\TypeName('date_time');
    }
}