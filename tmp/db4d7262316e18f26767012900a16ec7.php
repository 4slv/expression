<?php

class expressiondb4d7262316e18f26767012900a16ec7
{
    public static function expressionFunctiondb4d7262316e18f26767012900a16ec7($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((($variableList->get('periodNumber')->getValue() > ((int)1)) ? expression9adb0450bba2f9e15025887816650a59::expressionFunction9adb0450bba2f9e15025887816650a59($functionList,$variableList)->getValue() : expression40382e2ebbef1c86c4343287115746f4::expressionFunction40382e2ebbef1c86c4343287115746f4($functionList,$variableList)->getValue()));
    }

    public static function getType()
    {
     //   return expressiondb4d7262316e18f26767012900a16ec7::expressionFunctiondb4d7262316e18f26767012900a16ec7()->getType();
        return new Slov\Expression\Type\TypeName('date_time');
    }
}