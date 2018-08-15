<?php

class expression2e939ad1de2d6e44afeacc90b3a58258
{
    public static function expressionFunction2e939ad1de2d6e44afeacc90b3a58258($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('actionParametersInfo')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('paymentPeriods'))->getValue());
    }

    public static function getType()
    {
     //   return expression2e939ad1de2d6e44afeacc90b3a58258::expressionFunction2e939ad1de2d6e44afeacc90b3a58258()->getType();
        return new Slov\Expression\Type\TypeName('int');
    }
}