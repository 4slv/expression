<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Code\CodeParseException;

/** Шаблоны преобразования операций в php-код */
class OperationToPhpTemplate
{
    /**
     * @param Operation $operation
     * @return string
     * @throws CodeParseException
     */
    public function sameCode(Operation $operation)
    {
        $replace = [
            '%operandLeft%' => $operation->getLeftOperand()->getPhp(),
            '%operationSign%' => $operation->getSign(),
            '%operandRight%' => $operation->getRightOperand()->getPhp()
        ];
        return str_replace(
            array_keys($replace),
            array_values($replace),
            '%operandLeft% %operationSign% %operandRight%'
        );
    }

    /**
     * @param Operation $operation операция
     * @param string $methodName название вызываемого метода
     * @return string
     */
    public function objectMethod(Operation $operation, string $methodName)
    {
        $replace = [
            '%operandLeft%' => $operation->getLeftOperand()->getPhp(),
            '%methodName%' => $methodName,
            '%operandRight%' => $operation->getRightOperand()->getPhp()
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            '%operandLeft%->%methodName%(%operandRight%)'
        );
    }
}