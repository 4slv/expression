<?php

class expressionc1bec5c3dc5d3ce9ef4ef8bb30245514
{
    public static function expressionFunctionc1bec5c3dc5d3ce9ef4ef8bb30245514($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('financeActionSettings')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('issue.paymentPeriod'))->getValue());
    }

    public static function getType()
    {
     //   return expressionc1bec5c3dc5d3ce9ef4ef8bb30245514::expressionFunctionc1bec5c3dc5d3ce9ef4ef8bb30245514()->getType();
        return new Slov\Expression\Type\TypeName('int');
    }
}