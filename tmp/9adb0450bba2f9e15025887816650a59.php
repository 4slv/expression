<?php

class expression9adb0450bba2f9e15025887816650a59
{
    public static function expressionFunction9adb0450bba2f9e15025887816650a59($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((expression9af1c83316bb9e209a49360d1a3d6869::expressionFunction9af1c83316bb9e209a49360d1a3d6869($functionList,$variableList)->getValue())->add((new DateInterval("P".(((expressionc1bec5c3dc5d3ce9ef4ef8bb30245514::expressionFunctionc1bec5c3dc5d3ce9ef4ef8bb30245514($functionList,$variableList)->getValue() * ($variableList->get('periodNumber')->getValue() - ((int)1))) + ((int)1)) - expression0f4e0430dc13822a42062f75cf523650::expressionFunction0f4e0430dc13822a42062f75cf523650($functionList,$variableList)->getValue())."D"))));
    }

    public static function getType()
    {
     //   return expression9adb0450bba2f9e15025887816650a59::expressionFunction9adb0450bba2f9e15025887816650a59()->getType();
        return new Slov\Expression\Type\TypeName('date_time');
    }
}