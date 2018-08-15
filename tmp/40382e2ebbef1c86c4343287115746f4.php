<?php

class expression40382e2ebbef1c86c4343287115746f4
{
    public static function expressionFunction40382e2ebbef1c86c4343287115746f4($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('creditPartInfo')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('date'))->getValue());
    }

    public static function getType()
    {
     //   return expression40382e2ebbef1c86c4343287115746f4::expressionFunction40382e2ebbef1c86c4343287115746f4()->getType();
        return new Slov\Expression\Type\TypeName('date_time');
    }
}