<?php

class expression645657a6505e326c4ed5adcefe3fbd4a
{
    public static function expressionFunction645657a6505e326c4ed5adcefe3fbd4a($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('financeActionSettings')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('issue.maxDaysInYear'))->getValue());
    }

    public static function getType()
    {
     //   return expression645657a6505e326c4ed5adcefe3fbd4a::expressionFunction645657a6505e326c4ed5adcefe3fbd4a()->getType();
        return new Slov\Expression\Type\TypeName('int');
    }
}