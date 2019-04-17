<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Bracket\BracketParserAccessor;
use Slov\Expression\Bracket\BracketType;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Type\TypeRegExp;

/** Выражение со скобками */
class ExpressionWithBrackets extends Expression
{
    use BracketParserAccessor;

    /** @var ExpressionWithoutBracketsFinder поиск выражения без скобок */
    protected $expressionWithoutBracketsFinder;

    /**
     * @return ExpressionWithoutBracketsFinder поиск выражения без скобок
     */
    public function getExpressionWithoutBracketsFinder(): ExpressionWithoutBracketsFinder
    {
        if(is_null($this->expressionWithoutBracketsFinder)){
            $this->expressionWithoutBracketsFinder = new ExpressionWithoutBracketsFinder();
        }
        return $this->expressionWithoutBracketsFinder;
    }

    /**
     * Разбор функций из псевдокода и замена их метками
     * @param CodeContext $codeContext контекст кода
     * @return string псевдокод с метками вместо вызовов функций
     * @throws CodeParseException
     */
    protected function parseFunctions(CodeContext $codeContext): string
    {
        $expressionCode = $this->getCodeTrim();

        while (preg_match('/'. TypeRegExp::FUNCTION.'/msi', $expressionCode, $match))
        {
            $parametersCode = $this
                ->getBracketParser()
                ->parseFirstGroup(
                    $match[5],
                    BracketType::byValue(BracketType::ROUND_BRACKETS)
                );
            $functionCallCode = $match[1]. $parametersCode;
            $functionCallLabel = $this
                ->createFunctionCall()
                ->setCode($functionCallCode)
                ->parse($codeContext)
                ->getLabel();

            $expressionCode = $this->stringReplaceOnce(
                $functionCallCode,
                $functionCallLabel,
                $expressionCode
            );
        }
        return $expressionCode;
    }

    protected function defineExpressionPart(CodeContext $codeContext): ExpressionPart
    {
        $expressionWithoutBracketsFinder = $this->getExpressionWithoutBracketsFinder();
        $expressionCode = $this->parseFunctions($codeContext);
        $expressionPart = $codeContext->checkLabelIsExpressionPart($expressionCode)
            ? $codeContext->getExpressionPartByLabel($expressionCode)
            : null;

        while ($codeContext->checkLabelIsExpressionPart($expressionCode) === false){
            $expressionPart = $expressionWithoutBracketsFinder
                ->find($codeContext, $expressionCode);

            $expressionCode = $this->stringReplaceOnce(
                $expressionPart->getOriginalCode(),
                $expressionPart->getLabel(),
                $expressionCode
            );
        }
        return $expressionPart;
    }

}