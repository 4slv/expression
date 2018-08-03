<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Type\Type;

/** Список выражений в текстовом представлении */
class TextExpressionList
{
    /**
     * @var VariableList список переменных
     */
    private $variableList;

    /**
     * @var TextExpression[] ассоциативный массив с текстовыми выражениями
     */
    private $list = [];

    /**
     * @return TextExpression[] ассоциативный массив с текстовыми выражениями
     */
    protected function getList(): array
    {
        return $this->list;
    }

    /**
     * @param VariableList $variableList список переменных
     * @return $this
     */
    public function setVariableList(VariableList $variableList)
    {
        $this->variableList = $variableList;
        return $this;
    }

    /**
     * @return VariableList список переменных
     */
    public function getVariableList(): VariableList
    {
        if(is_null($this->variableList)){
            $this->variableList = new VariableList();
        }
        return $this->variableList;
    }

    /** Добавление выражения в список
     * @param string $name название выражения
     * @param TextExpression $textExpression выражение
     * @return TextExpressionList
     */
    public function append(string $name, TextExpression $textExpression) : TextExpressionList
    {
        $textExpression->setVariableList($this->getVariableList());
        $this->list[$name] = $textExpression;
        $this->getVariableList()->append($name, $textExpression->toExpression());
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
     * @param string $name
     */
    public function remove(string $name): void
    {
        if(array_key_exists($name, $this->list))
        {
            unset($this->list[$name]);
        }
    }

    /**
     * @param TextExpression $textExpression
     * @return Type
     */
    public function execute(TextExpression $textExpression)
    {
        $name = 'execute'. uniqid();
        $this->append($name, $textExpression);
        $returned = $this
            ->get($name)
            ->toExpression()->calculate();
        $this->remove($name);
        return $returned;
    }
}
