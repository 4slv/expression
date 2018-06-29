<?php

namespace Slov\Expression\TextExpression;


use Slov\Expression\Expression;

/** Структура цикла for */
class ForStructure
{
    /** @var Expression выражение выполняющееся первым */
    private $first;

    /** @var Expression логическое выражение, пока true - цикл не завершается */
    private $condition;

    /** @var Expression выражение выполняющееся каждый шаг */
    private $eachStep;

    /** @var Expression выражение, которое необходимо многократно повторить */
    private $action;

    /**
     * @return Expression выражение выполняющееся первым
     */
    public function getFirst(): Expression
    {
        return $this->first;
    }

    /**
     * @param Expression $first выражение выполняющееся первым
     * @return $this
     */
    public function setFirst(Expression $first)
    {
        $this->first = $first;
        return $this;
    }

    /**
     * @return Expression логическое выражение, пока true - цикл не завершается
     */
    public function getCondition(): Expression
    {
        return $this->condition;
    }

    /**
     * @param Expression $condition логическое выражение, пока true - цикл не завершается
     * @return $this
     */
    public function setCondition(Expression $condition)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return Expression выражение выполняющееся каждый шаг
     */
    public function getEachStep(): Expression
    {
        return $this->eachStep;
    }

    /**
     * @param Expression $eachStep выражение выполняющееся каждый шаг
     * @return $this
     */
    public function setEachStep(Expression $eachStep)
    {
        $this->eachStep = $eachStep;
        return $this;
    }

    /**
     * @return Expression выражение, которое необходимо многократно повторить
     */
    public function getAction(): Expression
    {
        return $this->action;
    }

    /**
     * @param Expression $action выражение, которое необходимо многократно повторить
     * @return $this
     */
    public function setAction(Expression $action)
    {
        $this->action = $action;
        return $this;
    }


}