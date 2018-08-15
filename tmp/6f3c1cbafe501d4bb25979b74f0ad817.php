<?php

class expression6f3c1cbafe501d4bb25979b74f0ad817
{
    public static function expressionFunction6f3c1cbafe501d4bb25979b74f0ad817($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((expression68aadffe1bf0761222cdb7ce46ff62fa::expressionFunction68aadffe1bf0761222cdb7ce46ff62fa($functionList,$variableList)->getValue() * expressionc1bec5c3dc5d3ce9ef4ef8bb30245514::expressionFunctionc1bec5c3dc5d3ce9ef4ef8bb30245514($functionList,$variableList)->getValue()));
    }

    public static function getType()
    {
     //   return expression6f3c1cbafe501d4bb25979b74f0ad817::expressionFunction6f3c1cbafe501d4bb25979b74f0ad817()->getType();
        return new Slov\Expression\Type\TypeName('float');
    }
}