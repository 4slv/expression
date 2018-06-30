<?php

namespace Slov\Expression\TextExpression;


use Slov\Expression\Expression;
use Slov\Expression\Type\Type;

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
     * @return Expression|Type выражение выполняющееся первым
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @param Expression|Type $first выражение выполняющееся первым
     * @return $this
     */
    public function setFirst($first)
    {
        $this->first = $first;
        return $this;
    }

    /**
     * @return Expression|Type логическое выражение, пока true - цикл не завершается
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param Expression|Type $condition логическое выражение, пока true - цикл не завершается
     * @return $this
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return Expression|Type выражение выполняющееся каждый шаг
     */
    public function getEachStep()
    {
        return $this->eachStep;
    }

    /**
     * @param Expression|Type $eachStep выражение выполняющееся каждый шаг
     * @return $this
     */
    public function setEachStep($eachStep)
    {
        $this->eachStep = $eachStep;
        return $this;
    }

    /**
     * @return Expression|Type выражение, которое необходимо многократно повторить
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param Expression|Type $action выражение, которое необходимо многократно повторить
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }


}