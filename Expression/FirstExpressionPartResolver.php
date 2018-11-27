<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Code\CodeAccessor;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePartFactory;
use Slov\Expression\Operation\Operation;
use Slov\Expression\Operation\PriorityOperationFinder;

/** Определение первой части выражения */
class FirstExpressionPartResolver
{
    use CodeAccessor;
    use CodePartFactory;

    /** @var PriorityOperationFinder поиск приоритетной операции */
    protected $priorityOperationFinder;

    /** @return PriorityOperationFinder поиск приоритетной операции */
    protected function getPriorityOperationFinder(): PriorityOperationFinder
    {
        if(is_null($this->priorityOperationFinder))
        {
            $this->priorityOperationFinder = new PriorityOperationFinder();
        }
        return $this->priorityOperationFinder;
    }

    /**
     * @param CodeContext $codeContext контекст кода
     * @param string $code код
     * @return ExpressionPart операция или операнд
     * @throws CodeParseException
     */
    public function resolve(CodeContext $codeContext, string $code): ExpressionPart
    {
        $priorityOperationFinder = $this->getPriorityOperationFinder()->init($code);
        return count($priorityOperationFinder->getOperationInfoList()) > 0
            ? $this
                ->buildOperation(
                    $codeContext,
                    $priorityOperationFinder->find()
                )
            : $this
                ->createOperand()
                ->setCode($code)
                ->parse($codeContext);
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
}