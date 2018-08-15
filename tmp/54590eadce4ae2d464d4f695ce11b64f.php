<?php

class expression54590eadce4ae2d464d4f695ce11b64f
{
    public static function expressionFunction54590eadce4ae2d464d4f695ce11b64f($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((new \DateTime())
    ->setDate(expression9adb0450bba2f9e15025887816650a59::expressionFunction9adb0450bba2f9e15025887816650a59($functionList,$variableList)->getValue()->format('Y'), 1, 1)
    ->setTime(0,0,0));
    }

    public static function getType()
    {
     //   return expression54590eadce4ae2d464d4f695ce11b64f::expressionFunction54590eadce4ae2d464d4f695ce11b64f()->getType();
        return new Slov\Expression\Type\TypeName('date_time');
    }
}