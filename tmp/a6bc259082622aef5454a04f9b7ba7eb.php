<?php

class expressiona6bc259082622aef5454a04f9b7ba7eb
{
    public static function expressionFunctiona6bc259082622aef5454a04f9b7ba7eb($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('actionParametersInfo')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('creditDailyPercent'))->getValue());
    }

    public static function getType()
    {
     //   return expressiona6bc259082622aef5454a04f9b7ba7eb::expressionFunctiona6bc259082622aef5454a04f9b7ba7eb()->getType();
        return new Slov\Expression\Type\TypeName('float');
    }
}