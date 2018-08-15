<?php

class expressionbac6573c8ad90f5bfc9e04ab0cfa3f1c
{
    public static function expressionFunctionbac6573c8ad90f5bfc9e04ab0cfa3f1c($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('creditPartAccountBalance')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('planActivationDate'), Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('calculatedPaymentCurrentPeriod'), expressiondb4d7262316e18f26767012900a16ec7::expressionFunctiondb4d7262316e18f26767012900a16ec7($functionList,$variableList))->getValue());
    }

    public static function getType()
    {
     //   return expressionbac6573c8ad90f5bfc9e04ab0cfa3f1c::expressionFunctionbac6573c8ad90f5bfc9e04ab0cfa3f1c()->getType();
        return new Slov\Expression\Type\TypeName('money');
    }
}