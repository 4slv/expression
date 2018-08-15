<?php

class expression1916350710f6e7ab089ffdacd97c877d
{
    public static function expressionFunction1916350710f6e7ab089ffdacd97c877d($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(($functionList->get('actionParametersInfo')->getFunction())(Slov\Expression\Type\TypeFactory::getInstance()->create(new Slov\Expression\Type\TypeName('string'))->setValue('issueDateTime'))->getValue());
    }

    public static function getType()
    {
     //   return expression1916350710f6e7ab089ffdacd97c877d::expressionFunction1916350710f6e7ab089ffdacd97c877d()->getType();
        return new Slov\Expression\Type\TypeName('date_time');
    }
}