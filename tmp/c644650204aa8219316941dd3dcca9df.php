<?php

class expressionc644650204aa8219316941dd3dcca9df
{
    public static function expressionFunctionc644650204aa8219316941dd3dcca9df($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((($functionList->get('actionParametersInfo')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('creditAmount'))->getValue() ->mul ((int)100)));
    }

    public static function getType()
    {
     //   return expressionc644650204aa8219316941dd3dcca9df::expressionFunctionc644650204aa8219316941dd3dcca9df()->getType();
        return new Slov\Expression\Type\TypeName('money');
    }
}