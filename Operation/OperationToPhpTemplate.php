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
}