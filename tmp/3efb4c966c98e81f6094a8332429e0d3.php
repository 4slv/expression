<?php

class expression3efb4c966c98e81f6094a8332429e0d3
{
    public static function expressionFunction3efb4c966c98e81f6094a8332429e0d3($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((expressionbfc62c0290ccd546030cfd427970e959::expressionFunctionbfc62c0290ccd546030cfd427970e959($functionList,$variableList)->getValue()->format('L') == '1' ? 366 : 365 ));
    }

    public static function getType()
    {
     //   return expression3efb4c966c98e81f6094a8332429e0d3::expressionFunction3efb4c966c98e81f6094a8332429e0d3()->getType();
        return new Slov\Expression\Type\TypeName('int');
    }
}