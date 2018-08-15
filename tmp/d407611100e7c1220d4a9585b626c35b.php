<?php

class expressiond407611100e7c1220d4a9585b626c35b
{
    public static function expressionFunctiond407611100e7c1220d4a9585b626c35b($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('separateProduct')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('fixParts'), Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('int'))->setValue(((int)1)))->getValue());
    }

    public static function getType()
    {
     //   return expressiond407611100e7c1220d4a9585b626c35b::expressionFunctiond407611100e7c1220d4a9585b626c35b()->getType();
        return new Slov\Expression\Type\TypeName('boolean');
    }
}