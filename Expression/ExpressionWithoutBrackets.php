<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Operation\PriorityOperationFinder;

/** Выражение без скобок */
class ExpressionWithoutBrackets extends Expression
{
    /** @var PriorityOperationFinder поиск приоритетной операции */
    protected $priorityOperationFinder;

    /** @return PriorityOperationFinder поиск приоритетной операции */
    public function getPriorityOperationFinder(): PriorityOperationFinder
    {
        if(is_null($this->priorityOperationFinder))
        {
            $this->priorityOperationFinder = new PriorityOperationFinder($this->getCode());
        }
        return $this->priorityOperationFinder;
    }

    /** Создание операции
     * @param CodeContext $codeContext контекст кода
     * @param string $operationCode код операции
     * @return Operation операция
     * @throws CodeParseException */
    protected function buildOperation(CodeContext $codeContext, string $operationCode)
    {
        return $this
            ->createOperation()
            ->setCode($operationCode)
            ->parse($codeContext);
    }

    protected function defineExpressionPart(CodeContext $codeContext): ExpressionPart
    {
        $priorityOperationFinder = $this->getPriorityOperationFinder();
        $expressionCode = $this->getCode();
        $expressionPart = null;
        while ($codeContext->checkLabelIsExpressionPart($expressionCode) === false)
        {
            $maxPriorityOperationCode = $expressionCode === $this->getCode()
                ? $priorityOperationFinder->find()
                : $priorityOperationFinder->init($expressionCode)->find();
            $expressionPart = $this->buildOperation($codeContext, $maxPriorityOperationCode);
            $replaceTimes = 1;
            $expressionCode = str_replace(
                $maxPriorityOperationCode,
                $expressionPart->getLabel(),
                $expressionCode,
                $replaceTimes
            );
        }
        return $expressionPart;
    }
}