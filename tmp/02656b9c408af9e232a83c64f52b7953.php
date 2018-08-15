<?php

class expression02656b9c408af9e232a83c64f52b7953
{
    public static function expressionFunction02656b9c408af9e232a83c64f52b7953($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('creditPartAccountBalance')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('planActivationDate'), Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('calculatedPrincipalRestCurrentPeriod'), expressiondb4d7262316e18f26767012900a16ec7::expressionFunctiondb4d7262316e18f26767012900a16ec7($functionList,$variableList))->getValue());
    }

    public static function getType()
    {
     //   return expression02656b9c408af9e232a83c64f52b7953::expressionFunction02656b9c408af9e232a83c64f52b7953()->getType();
        return new Slov\Expression\Type\TypeName('money');
    }
}