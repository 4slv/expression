<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Code\CodePartFactory;
use Slov\Expression\Type\TypeName;

/** Тернарный условный оператор ... ? ... : ... */
class IfElseOperation extends Operation
{
    use CodePartFactory;

    const TEMPLATE = '(%condition% ? %success% : %failed%)';
    const SIGN_REGEXP = '([^\?]+?)\?([^\:]+?)\:(.+)';

    /** @var string метка условия */
    protected $conditionLabel;

    /** @var string метка выражения выполняемого в случае успеха */
    protected $successLabel;

    /** @var string метка выражения выполняемого в случае неудачи */
    protected $failedLabel;

    public function typeDefinition(CodeContext $codeContext): TypeName
    {
        $successType = $codeContext
            ->getExpressionPartByLabel($this->successLabel)
            ->getTypeName();
        $failedType = $codeContext
            ->getExpressionPartByLabel($this->failedLabel)
            ->getTypeName();
        if(
            $successType->getValue() === $failedType->getValue()
        )
        {
            return $successType;
        }

        $operationCode = $this->getOperation()->getCodeTrim();
        throw new CodeParseException(
            $operationCode. ' :: success and failed return types are not equal'
        );
    }

    public function toPhp(CodeContext $codeContext): string
    {
        $conditionExpression = $codeContext->getExpressionPartByLabel($this->conditionLabel);
        $successExpression = $codeContext->getExpressionPartByLabel($this->successLabel);
        $failedExpression = $codeContext->getExpressionPartByLabel($this->failedLabel);
        if(
            $successExpression->getTypeName()->getValue()
            ===
            $failedExpression->getTypeName()->getValue()
        )
        {
            $replace = [
                '%condition%' => $conditionExpression->getPhp(),
                '%success%' => $successExpression->getPhp(),
                '%failed%' => $failedExpression->getPhp()
            ];
            return str_replace(
                array_keys($replace),
                array_values($replace),
                self::TEMPLATE
            );
        }

        return parent::toPhp($codeContext);
    }

    protected function parseOperationParts(CodeContext $codeContext): void
    {
        $operationCode = $this->getCodeTrim();
        if(preg_match(
            '/^'. self::SIGN_REGEXP. '$/',
            $operationCode,
            $match
        )){
            $this->conditionLabel = $this->parseCode($codeContext, $match[1]);
            $this->successLabel = $this->parseCode($codeContext, $match[2]);
            $this->failedLabel = $this->parseCode($codeContext, $match[3]);
        } else {
            throw new CodeParseException(
                $operationCode. ' :: code is not if/else operation'
            );
        }
    }

    /**
     * Разбор псевдокода и получение метки части выражения
     * @param CodeContext $codeContext контекст кода
     * @param string $code псевдокод условия
     * @return string метка части выражения
     * @throws CodeParseException
     */
    protected function parseCode(CodeContext $codeContext, string $code): string
    {
        return $this
            ->createExpressionWithBrackets()
            ->setCode($code)
            ->parse($codeContext)
            ->getLabel();
    }
}