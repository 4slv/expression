<?php

namespace Slov\Expression\Operation;


use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Helper\Interval;

/** Шаблоны преобразования операций в php-код */
class OperationToPhpTemplate
{
    /**
     * Получение php кода идентичному псевдокоду операции
     * @param Operation $operation операция
     * @return string php-код операции
     * @throws CodeParseException
     */
    public function sameCode(Operation $operation): string
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
     * Получение php кода вызова метода объекта из операции
     * @param Operation $operation операция
     * @param string $methodName название вызываемого метода
     * @return string
     */
    public function objectMethod(Operation $operation, string $methodName): string
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

    /**
     * Получение php кода вызова метода объекта из операции (с инверсией операндов)
     * @param Operation $operation операция
     * @param string $methodName название вызываемого метода
     * @return string
     */
    public function objectMethodReverse(Operation $operation, string $methodName): string
    {
        $replace = [
            '%operandLeft%' => $operation->getLeftOperand()->getPhp(),
            '%methodName%' => $methodName,
            '%operandRight%' => $operation->getRightOperand()->getPhp()
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            '%operandRight%->%methodName%(%operandLeft%)'
        );
    }

    public function intervalMethod(Operation $operation, string $methodName): string
    {
        $replace = [
            '%operandLeft%' => $operation->getLeftOperand()->getPhp(),
            '%methodName%' => Interval::class. '::'. $methodName,
            '%operandRight%' => $operation->getRightOperand()->getPhp()
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            '%methodName%(%operandLeft%, %operandRight%)'
        );
    }
}