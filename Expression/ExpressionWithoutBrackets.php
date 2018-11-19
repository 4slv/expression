<?php

namespace Slov\Expression\Expression;


use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Operation\PriorityOperationFinder;

/** Выражение без скобок */
class ExpressionWithoutBrackets extends Expression
{
    /** @var bool флаг использования обрамляющих скобок */
    protected $useBrackets;

    /** @var PriorityOperationFinder поиск приоритетной операции */
    protected $priorityOperationFinder;

    /**
     * @return bool флаг использования обрамляющих скобок
     */
    public function getUseBrackets(): bool
    {
        return $this->useBrackets;
    }

    /**
     * @param bool $useBrackets флаг использования обрамляющих скобок
     * @return $this
     */
    public function setUseBrackets(bool $useBrackets)
    {
        $this->useBrackets = $useBrackets;
        return $this;
    }

    /** @return PriorityOperationFinder поиск приоритетной операции */
    public function getPriorityOperationFinder(): PriorityOperationFinder
    {
        if(is_null($this->priorityOperationFinder))
        {
            $this->priorityOperationFinder = new PriorityOperationFinder($this->getCode());
        }
        return $this->priorityOperationFinder;
    }

    /**
     * @return string получение изначального кода
     */
    public function getOriginalCode(): string
    {
        return $this->getUseBrackets()
            ? '('. $this->getCode(). ')'
            : $this->getCode();
    }

    /** Создание операции
     * @param CodeContext $codeContext контекст кода
     * @param string $operationCode код операции
     * @return Operation операция
     * @throws CodeParseException */
    protected function createOperation(CodeContext $codeContext, string $operationCode)
    {
        $operation = new Operation();
        return $operation
            ->setCode($operationCode)
            ->parse($codeContext);
    }

    protected function defineOperation(CodeContext $codeContext): Operation
    {
        $priorityOperationFinder = $this->getPriorityOperationFinder();
        $expressionCode = $this->getCode();
        $operation = null;
        while ($codeContext->checkLabelIsExpressionPart($expressionCode) === false)
        {
            $maxPriorityOperationCode = $expressionCode === $this->getCode()
                ? $priorityOperationFinder->find()
                : $priorityOperationFinder->init($expressionCode)->find();
            $operation = $this->createOperation($codeContext, $maxPriorityOperationCode);
            $replaceTimes = 1;
            $expressionCode = str_replace(
                $maxPriorityOperationCode,
                $operation->getLabel(),
                $expressionCode,
                $replaceTimes
            );
        }
        return $operation;
    }
}