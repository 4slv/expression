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
            $operationRegexp = '/^(.*)('. $signRegexp. ')(.*)$/';
            if(preg_match($operationRegexp, $code, $match)){
                $leftOperandCode = $match[1];
                $operationSignCode = $match[2];
                $rightOperandCode = $match[3];

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