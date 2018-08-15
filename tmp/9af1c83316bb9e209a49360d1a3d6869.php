<?php

class expression9af1c83316bb9e209a49360d1a3d6869
{
    public static function expressionFunction9af1c83316bb9e209a49360d1a3d6869($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((new DateTime((expression40382e2ebbef1c86c4343287115746f4::expressionFunction40382e2ebbef1c86c4343287115746f4($functionList,$variableList)->getValue())->format('Y-m-d'))));
    }

    public static function getType()
    {
     //   return expression9af1c83316bb9e209a49360d1a3d6869::expressionFunction9af1c83316bb9e209a49360d1a3d6869()->getType();
        return new Slov\Expression\Type\TypeName('date_time');
    }
}