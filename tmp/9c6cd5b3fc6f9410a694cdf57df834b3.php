<?php

class expression9c6cd5b3fc6f9410a694cdf57df834b3
{
    public static function expressionFunction9c6cd5b3fc6f9410a694cdf57df834b3($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('creditPartAccountBalance')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('planActivationDate'), Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('calculatedInterestCurrentPeriod'), expressiondb4d7262316e18f26767012900a16ec7::expressionFunctiondb4d7262316e18f26767012900a16ec7($functionList,$variableList))->getValue());
    }

    public static function getType()
    {
     //   return expression9c6cd5b3fc6f9410a694cdf57df834b3::expressionFunction9c6cd5b3fc6f9410a694cdf57df834b3()->getType();
        return new Slov\Expression\Type\TypeName('money');
    }
}