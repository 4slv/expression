<?php

namespace Slov\Expression\TextExpression;

/** Список выражений в текстовом представлении */
class TextExpressionList
{
    /**
     * @var TextExpression[] ассоциативный массив с текстовыми выражениями
     */
    private $list = [];

    /**
     * @return TextExpression[]
     */
    protected function getList(): array
    {
        return $this->list;
    }

    /** Добавление выражения в список
     * @param string $name название выражения
     * @param TextExpression $textExpression выражение
     * @return TextExpressionList
     */
    public function append(string $name, TextExpression $textExpression) : TextExpressionList
    {
        $variableList = $this->createVariableList($textExpression);

        $textExpression->setVariableList($variableList);

        $this->list[$name] = $textExpression;

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
     * Создания списка переменных для текстового выражения
     * @param TextExpression $textExpression текстовое выражение
     * @return VariableList
     */
    private function createVariableList(TextExpression $textExpression) : VariableList
    {
        $variableList = clone $textExpression->getVariableList();
        foreach ($this->getList() as $listExpressionName => $listTextExpression){
            $listTextVariableList = $listTextExpression->getVariableList()->getAll();
            foreach ($listTextVariableList as $listTextVariableName => $listTextVariable){
                if($variableList->exists($listTextVariableName) === false){
                    $variableList->append($listTextVariableName, $listTextVariable);
                }
            }
            $listExpression = $listTextExpression->toExpression();
            $variableList->append($listExpressionName, $listExpression);
        }
        return $variableList;
    }
}