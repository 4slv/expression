<?php

function expression9e60c24901791357d3adf8d9821dded2($functionList,$variableList)
{
    return (function($functionList,$variableList){
    for(($i = (int)1);($i < (int)10000);($i = ($i + (int)1))){
        ((int)5 + (($functionList->get('test')->getFunction())(((int)5 + ($variableList->get('c')->getValue() + (int)1))) + (int)1));
    }
    return true;
})($functionList,$variableList);
}