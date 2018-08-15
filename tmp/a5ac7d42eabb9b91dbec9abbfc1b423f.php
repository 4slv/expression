<?php

class expressiona5ac7d42eabb9b91dbec9abbfc1b423f
{
    public static function expressionFunctiona5ac7d42eabb9b91dbec9abbfc1b423f($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('creditPartAccountBalance')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('planActivationDate'), Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('calculatedPrincipalCurrentPeriod'), expressiondb4d7262316e18f26767012900a16ec7::expressionFunctiondb4d7262316e18f26767012900a16ec7($functionList,$variableList))->getValue());
    }

    public static function getType()
    {
     //   return expressiona5ac7d42eabb9b91dbec9abbfc1b423f::expressionFunctiona5ac7d42eabb9b91dbec9abbfc1b423f()->getType();
        return new Slov\Expression\Type\TypeName('money');
    }
}