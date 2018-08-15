<?php

class expression450e6656864b57a1b6a2b32093907e9f
{
    public static function expressionFunction450e6656864b57a1b6a2b32093907e9f($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('creditPartInfo')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('amount'))->getValue());
    }

    public static function getType()
    {
     //   return expression450e6656864b57a1b6a2b32093907e9f::expressionFunction450e6656864b57a1b6a2b32093907e9f()->getType();
        return new Slov\Expression\Type\TypeName('money');
    }
}