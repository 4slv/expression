<?php

class expression0f4e0430dc13822a42062f75cf523650
{
    public static function expressionFunction0f4e0430dc13822a42062f75cf523650($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((($variableList->get('periodNumber')->getValue() === ((int)1)) ? ((int)1) : ((int)0)));
    }

    public static function getType()
    {
     //   return expression0f4e0430dc13822a42062f75cf523650::expressionFunction0f4e0430dc13822a42062f75cf523650()->getType();
        return new Slov\Expression\Type\TypeName('int');
    }
}