<?php

class expression3d30582e5b6ebaa2c0984bf0ee67a24e
{
    public static function expressionFunction3d30582e5b6ebaa2c0984bf0ee67a24e($functionList,$variableList)
    {
        $for = [];
        return Helper\Cast\CastExpressionType::leadTypeByStructure(((function($functionList,$variableList){
    $days = ((
        expression54590eadce4ae2d464d4f695ce11b64f::expressionFunction54590eadce4ae2d464d4f695ce11b64f($functionList,$variableList)->getValue() == expression74509a8d0e2995696a81987dbac82fe3::expressionFunction74509a8d0e2995696a81987dbac82fe3($functionList,$variableList)->getValue()) ? ((expressionbfc62c0290ccd546030cfd427970e959::expressionFunctionbfc62c0290ccd546030cfd427970e959($functionList,$variableList)->getValue() - expression9adb0450bba2f9e15025887816650a59::expressionFunction9adb0450bba2f9e15025887816650a59($functionList,$variableList)->getValue()))->add((new DateInterval('P0Y0M1DT0H0M0S'))) : expression9adb0450bba2f9e15025887816650a59::expressionFunction9adb0450bba2f9e15025887816650a59($functionList,$variableList)->getValue()->diff(expression74509a8d0e2995696a81987dbac82fe3::expressionFunction74509a8d0e2995696a81987dbac82fe3($functionList,$variableList)->getValue())
    )->format('%a');
    if( $days == "(unknown)")
        $days = (int)((new DateTime())->setTimeStamp(0)->add(((expression54590eadce4ae2d464d4f695ce11b64f::expressionFunction54590eadce4ae2d464d4f695ce11b64f($functionList,$variableList)->getValue() == expression74509a8d0e2995696a81987dbac82fe3::expressionFunction74509a8d0e2995696a81987dbac82fe3($functionList,$variableList)->getValue()) ? ((expressionbfc62c0290ccd546030cfd427970e959::expressionFunctionbfc62c0290ccd546030cfd427970e959($functionList,$variableList)->getValue() - expression9adb0450bba2f9e15025887816650a59::expressionFunction9adb0450bba2f9e15025887816650a59($functionList,$variableList)->getValue()))->add((new DateInterval('P0Y0M1DT0H0M0S'))) : expression9adb0450bba2f9e15025887816650a59::expressionFunction9adb0450bba2f9e15025887816650a59($functionList,$variableList)->getValue()->diff(expression74509a8d0e2995696a81987dbac82fe3::expressionFunction74509a8d0e2995696a81987dbac82fe3($functionList,$variableList)->getValue())))->getTimeStamp()/86400);
    return $days;
})($functionList,$variableList) - expression0f4e0430dc13822a42062f75cf523650::expressionFunction0f4e0430dc13822a42062f75cf523650($functionList,$variableList)->getValue()));
    }

    public static function getType()
    {
     //   return expression3d30582e5b6ebaa2c0984bf0ee67a24e::expressionFunction3d30582e5b6ebaa2c0984bf0ee67a24e()->getType();
        return new Slov\Expression\Type\TypeName('unknown');
    }
}