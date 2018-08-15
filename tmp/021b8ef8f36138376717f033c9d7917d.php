<?php

class expression021b8ef8f36138376717f033c9d7917d
{
    public static function expressionFunction021b8ef8f36138376717f033c9d7917d($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('createCreditPartTransaction')->getFunction())(expression40382e2ebbef1c86c4343287115746f4::expressionFunction40382e2ebbef1c86c4343287115746f4($functionList,$variableList), expression40382e2ebbef1c86c4343287115746f4::expressionFunction40382e2ebbef1c86c4343287115746f4($functionList,$variableList), expression450e6656864b57a1b6a2b32093907e9f::expressionFunction450e6656864b57a1b6a2b32093907e9f($functionList,$variableList), Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('calculatedPrincipalRestCurrentPeriod'), Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('calculatedService'), Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('issue'), Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('boolean'))->setValue(((bool)true)))->getValue());
    }

    public static function getType()
    {
     //   return expression021b8ef8f36138376717f033c9d7917d::expressionFunction021b8ef8f36138376717f033c9d7917d()->getType();
        return new Slov\Expression\Type\TypeName('boolean');
    }
}