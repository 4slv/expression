<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;

/** Тернарный условный оператор ... ? ... : ... */
class IfElseOperation extends Operation
{
    /** @var string метка условия */
    protected $conditionLabel;

    /** @var string метка выражения выполняемого в случае успеха */
    protected $successLabel;

    /** @var string метка выражения выполняемого в случае неудачи */
    protected $failedLabel;

    protected function parseOperationParts(CodeContext $codeContext): void
    {
        $operationCode = $this->getOperation()->getCodeTrim();
        if(preg_match(
            '/^'. OperationSignRegexp::IF_ELSE. '$/',
            $operationCode,
            $match
        )){
            $conditionCode = $match[1];
            $successCode = $match[2];
            $failedCode = $match[3];

        } else {
            throw new CodeParseException(
                $operationCode. ' :: code is not if/else operation'
            );
        }
    }

    /**
     * Разбор условия тернарного оператора
     * @param CodeContext $codeContext контекст кода
     */
    protected function parseCondition(CodeContext $codeContext): void
    {
        
    }
}