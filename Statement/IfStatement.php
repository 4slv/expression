<?php

namespace Slov\Expression\Statement;


use Slov\Expression\Bracket\BracketParserAccessor;
use Slov\Expression\Bracket\BracketType;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;

class IfStatement extends Statement
{
    use BracketParserAccessor;

    const TEMPLATE = "if(%condition%)\n{\n%successCodeBlock%\n}";

    /** @var string метка усовного выражения */
    protected $conditionExpressionLabel;

    /** @var string метка блока кода выполняемого в случае успеха */
    protected $successCodeBlockLabel;

    /**
     * @return string метка усовного выражения
     */
    public function getConditionExpressionLabel(): string
    {
        return $this->conditionExpressionLabel;
    }

    /**
     * @param string $conditionExpressionLabel метка усовного выражения
     * @return $this
     */
    public function setConditionExpressionLabel(string $conditionExpressionLabel)
    {
        $this->conditionExpressionLabel = $conditionExpressionLabel;
        return $this;
    }

    /**
     * @return string метка блока кода выполняемого в случае успеха
     */
    public function getSuccessCodeBlockLabel(): string
    {
        return $this->successCodeBlockLabel;
    }

    /**
     * @param string $successCodeBlockLabel метка блока кода выполняемого в случае успеха
     * @return $this
     */
    public function setSuccessCodeBlockLabel(string $successCodeBlockLabel)
    {
        $this->successCodeBlockLabel = $successCodeBlockLabel;
        return $this;
    }

    protected function initStatement(CodeContext $codeContext): void
    {
        $this->initConditionExpression($codeContext);
        $this->initSuccessCodeBlock($codeContext);
    }

    /**
     * Инициализация условия
     * @param CodeContext $codeContext контекст кода
     * @throws CodeParseException
     */
    protected function initConditionExpression(CodeContext $codeContext): void
    {
        $conditionExpressionCode = $this
            ->getBracketParser()
            ->parseFirstGroupContent(
                $this->getCode(),
                BracketType::byValue(BracketType::ROUND_BRACKETS)
            );
        $conditionExpressionLabel = $this
            ->createExpressionWithBrackets()
            ->setCode($conditionExpressionCode)
            ->parse($codeContext)
            ->getLabel();
        $this->setConditionExpressionLabel($conditionExpressionLabel);
    }

    /**
     * Инициализация кодового блока выполняемого в случае успешного выполнения условия
     * @param CodeContext $codeContext контекст кода
     * @throws CodeParseException
     */
    protected function initSuccessCodeBlock(CodeContext $codeContext): void
    {
        $successCodeBlockCode = $this
            ->getBracketParser()
            ->parseFirstGroupContent(
                $this->getCode(),
                BracketType::byValue(BracketType::BRACES)
            );
        $successCodeBlockLabel = $this
            ->createCodeBlock()
            ->setCode($successCodeBlockCode)
            ->parse($codeContext);

        $this->setSuccessCodeBlockLabel($successCodeBlockLabel);
    }

    public function toPhp(CodeContext $codeContext): string
    {
        $replace = [
            '%condition%' => $codeContext
                ->getExpressionList()
                ->get($this->getConditionExpressionLabel()),
            '%successCodeBlock%' => $codeContext
                ->getCodeBlockList()
                ->get($this->successCodeBlockLabel)
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            self::TEMPLATE
        );
    }
}