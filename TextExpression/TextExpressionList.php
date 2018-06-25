<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\ExpressionException;
use Slov\Expression\Operation\OperationSign;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\TypeRegExp;
use Slov\Expression\FactoryRepository;
use Slov\Expression\Expression;

/** Список выражений в текстовом представлении */
class TextExpressionList
{
    /**
     * @var TextExpression[] ассоциативный массив с текстовыми выражениями
     */
    private $list = [];

    /** Добавление выражения в список
     * @param string $name название выражения
     * @param Expression $textExpression выражение
     * @return $this
     */
    public function append(string $name, TextExpression $textExpression) : TextExpressionList
    {
        $arrTextExpression = explode(':', $textExpression->getExpressionText());
        $strTextExpression = trim($arrTextExpression[1]);

        if(preg_match_all ('/'. TypeRegExp::VARIABLE. '/', $strTextExpression, $match)) {
            foreach ($match[1] as $var) {
                if ($this->get($var)) {
                    $strTextExpression =
                        preg_replace('/\$'.$var.'/', '('.$this->get($var)->getExpressionText().')', $strTextExpression);
                }
            }
        }

        $this->list[$name] = $textExpression;
        $textExpression->setExpressionText($strTextExpression);
        $textExpression->setVariableList($this->getVariableList());

        return $this;
    }

    /**
     * Получение текстового выражения по названию
     * @param string $name
     * @return null|TextExpression
     */
    public function get(string $name) : ?TextExpression
    {
        return $this->list[$name] ?? null;
    }

    /**
     * Получение списка переменных
     * @return VariableList
     */
    private function getVariableList() : VariableList
    {
        $variableList = new VariableList();
        foreach ($this->list as $name => $textExpression){
            if($textExpression instanceof TextExpression){
                $existVariables = $textExpression->getVariableList()->getAll();
                foreach ($existVariables as $variableName => $variableValue){
                    $variableList->append($variableName, $variableValue);
                }
            }
        }
        return $variableList;
    }
}