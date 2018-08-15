<?php

class expressionbdd0ca22850c1d55c5e78a3b12964757
{
    public static function expressionFunctionbdd0ca22850c1d55c5e78a3b12964757($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('creditPartInfo')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('paymentPeriods'))->getValue());
    }

    public static function getType()
    {
     //   return expressionbdd0ca22850c1d55c5e78a3b12964757::expressionFunctionbdd0ca22850c1d55c5e78a3b12964757()->getType();
        return new Slov\Expression\Type\TypeName('int');
    }
}