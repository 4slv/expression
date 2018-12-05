<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;

/** Распознаватель операции */
class OperationResolver
{
    use OperationSignRegexpAccessor;

    /**
     * @return OperationBuilder строитель операций
     */
    protected function createOperationBuilder()
    {
        return new OperationBuilder();
    }

    /** Распознать операцию
     * @param string $code псевдо код операции
     * @param CodeContext $codeContext
     * @return Operation
     * @throws CodeParseException */
    public function resolve(string $code, CodeContext $codeContext)
    {
        foreach ($this->getOperationSignRegexpList() as $operationName => $signRegexp)
        {
            $operationRegexp = '/'. $signRegexp. '/msi';
            if(preg_match($operationRegexp, $code, $match)){
                $operandList = preg_split('/'. $signRegexp. '/msi', $code);
                $leftOperandCode = $operandList[0];
                $operationSignCode = $match[0];
                $rightOperandCode = $operandList[1];
                $operationBuilder = $this
                    ->createOperationBuilder()
                    ->setOperationCode($code)
                    ->setLeftOperandCode($leftOperandCode)
                    ->setRightOperandCode($rightOperandCode)
                    ->setOperationSignCode($operationSignCode)
                    ->setOperationName(OperationName::byName($operationName))
                    ->build($codeContext);
                return $operationBuilder->getOperation();
            }
        }
        throw new CodeParseException($code. ' :: operation is not resolved');
    }
}