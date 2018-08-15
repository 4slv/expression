<?php

class expression35533e8d8a00749b0add37bc38db68e6
{
    public static function expressionFunction35533e8d8a00749b0add37bc38db68e6($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('creditPartInfo')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('percent'))->getValue());
    }

    public static function getType()
    {
     //   return expression35533e8d8a00749b0add37bc38db68e6::expressionFunction35533e8d8a00749b0add37bc38db68e6()->getType();
        return new Slov\Expression\Type\TypeName('float');
    }
}