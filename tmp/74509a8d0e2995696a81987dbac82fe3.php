<?php

class expression74509a8d0e2995696a81987dbac82fe3
{
    public static function expressionFunction74509a8d0e2995696a81987dbac82fe3($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure((new \DateTime())
    ->setDate(expressionbfc62c0290ccd546030cfd427970e959::expressionFunctionbfc62c0290ccd546030cfd427970e959($functionList,$variableList)->getValue()->format('Y'), 1, 1)
    ->setTime(0,0,0));
    }

    public static function getType()
    {
     //   return expression74509a8d0e2995696a81987dbac82fe3::expressionFunction74509a8d0e2995696a81987dbac82fe3()->getType();
        return new Slov\Expression\Type\TypeName('date_time');
    }
}