<?php

class expression68aadffe1bf0761222cdb7ce46ff62fa
{
    public static function expressionFunction68aadffe1bf0761222cdb7ce46ff62fa($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((expression35533e8d8a00749b0add37bc38db68e6::expressionFunction35533e8d8a00749b0add37bc38db68e6($functionList,$variableList)->getValue() / ((int)100)));
    }

    public static function getType()
    {
     //   return expression68aadffe1bf0761222cdb7ce46ff62fa::expressionFunction68aadffe1bf0761222cdb7ce46ff62fa()->getType();
        return new Slov\Expression\Type\TypeName('float');
    }
}