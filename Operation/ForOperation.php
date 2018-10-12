<?php

namespace Slov\Expression\Operation;

use Slov\Expression\TextExpression\ForStructure;

/** Операция for */
class ForOperation extends Operation
{
    const TEMPLATE_FIRST = 'first';

    const TEMPLATE_CONDITION = 'condition';

    const TEMPLATE_ACTION = 'action';

    const TEMPLATE_EACH_STEP = 'eachStep';

    /** @var ForStructure структура для цикла for */
    private $forStructure;

    /**
     * @return ForStructure структура для цикла for
     */
    public function getForStructure(): ForStructure
    {
        return $this->forStructure;
    }

    /**
     * @param ForStructure $forStructure
     * @return $this
     */
    public function setForStructure(ForStructure $forStructure)
    {
        $this->forStructure = $forStructure;
        return $this;
    }

    public function resolveReturnTypeName()
    {
        return $this->getTypeNameFactory()->createBoolean();
    }

    public function getPhpTemplate(): string
    {
        return $this->getPhpTemplateOperationOnly();
    }

    public function toPhp($code)
    {
        $for = $this->getForStructure();
        $first = $for->getFirst();
        $condition = $for->getCondition();
        $action = $for->getAction();
        $eachStep = $for->getEachStep();
        $firstPhp = $first->toPhp($first->getCode());
        $conditionPhp = $condition->toPhp($condition->getCode());
        $actionPhp = $action->toPhp($action->getCode());
        $eachStepPhp = $eachStep->toPhp($eachStep->getCode());
        $replace = [
            self::TEMPLATE_FIRST => $firstPhp,
            self::TEMPLATE_CONDITION => $conditionPhp,
            self::TEMPLATE_ACTION => $actionPhp,
            self::TEMPLATE_EACH_STEP => $eachStepPhp
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            $this->getPhpTemplateFor()
        );
    }

    private function getPhpTemplateFor()
    {
        $first = self::TEMPLATE_FIRST;
        $condition = self::TEMPLATE_CONDITION;
        $action = self::TEMPLATE_ACTION;
        $eachStep = self::TEMPLATE_EACH_STEP;
        return
            "(function(){ for($first;$condition;$eachStep){ $action; }; return true;})()";
    }
}