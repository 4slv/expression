<?php

namespace Slov\Expression\Statement;

use Slov\Expression\Bracket\BracketParserAccessor;
use Slov\Expression\Bracket\BracketType;
use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Expression\ExpressionResolverAccessor;

/** Инсттукция цикла for */
class ForStatement extends Statement
{
    use BracketParserAccessor;
    use ExpressionResolverAccessor;

    const TEMPLATE = "for(%first_step%;%condition%;%each_step%)\n{\n%each_step_block%\n}";

    /** @var string метка инструкции первого шага */
    protected $firstStepLabel;

    /** @var string метка условия */
    protected $conditionLabel;

    /** @var string метка инструкции для каждого шага */
    protected $eachStepLabel;

    /** @var string метка блока кода выполняемого для каждого шага */
    protected $eachStepBlockLabel;

    /**
     * @return string метка инструкции первого шага
     */
    public function getFirstStepLabel(): string
    {
        return $this->firstStepLabel;
    }

    /**
     * @param string $firstStepLabel метка инструкции первого шага
     * @return ForStatement
     */
    public function setFirstStepLabel(string $firstStepLabel): ForStatement
    {
        $this->firstStepLabel = $firstStepLabel;
        return $this;
    }

    /**
     * @return string метка условия
     */
    public function getConditionLabel(): string
    {
        return $this->conditionLabel;
    }

    /**
     * @param string $conditionLabel метка условия
     * @return ForStatement
     */
    public function setConditionLabel(string $conditionLabel): ForStatement
    {
        $this->conditionLabel = $conditionLabel;
        return $this;
    }

    /**
     * @return string метка инструкции для каждого шага
     */
    public function getEachStepLabel(): string
    {
        return $this->eachStepLabel;
    }

    /**
     * @param string $eachStepLabel метка инструкции для каждого шага
     * @return ForStatement
     */
    public function setEachStepLabel(string $eachStepLabel): ForStatement
    {
        $this->eachStepLabel = $eachStepLabel;
        return $this;
    }

    /**
     * @return string метка блока кода выполняемого для каждого шага
     */
    public function getEachStepBlockLabel(): string
    {
        return $this->eachStepBlockLabel;
    }

    /**
     * @param string $eachStepBlockLabel метка блока кода выполняемого для каждого шага
     * @return ForStatement
     */
    public function setEachStepBlockLabel(string $eachStepBlockLabel): ForStatement
    {
        $this->eachStepBlockLabel = $eachStepBlockLabel;
        return $this;
    }

    protected function initStatement(CodeContext $codeContext): void
    {
        $circleControlCode = $this
            ->getBracketParser()
            ->parseFirstGroupContent(
                $this->getCode(),
                BracketType::byValue(BracketType::ROUND_BRACKETS)
            );
        $circleControlCodeList = explode(';', $circleControlCode);
        if(count($circleControlCodeList) === 3)
        {
            $this->initFirstStep($codeContext, $circleControlCodeList[0]);
            $this->initCondition($codeContext, $circleControlCodeList[1]);
            $this->initEachStep($codeContext, $circleControlCodeList[2]);
            $this->initEachStepBlock($codeContext, $this->getCode());
        } else {
            throw new CodeParseException(
                $circleControlCode.
                ' :: code is not for code'
            );
        }

    }

    /**
     * Получение метки инструкции по псевдокоду
     * @param CodeContext $codeContext код контекста
     * @param string $code псевдокод инструкции
     * @return string метка инструкции
     */
    protected function getExpressionLabel(CodeContext $codeContext, string $code): string
    {
        return $this
            ->getExpressionResolver()
            ->setCode($code)
            ->resolve($codeContext)
            ->getLabel();
    }

    /**
     * Инициализация инструкции первого шага
     * @param CodeContext $codeContext код контекста
     * @param string $code псевдокод инструкции
     */
    protected function initFirstStep(CodeContext $codeContext, string $code): void
    {
        $this->setFirstStepLabel(
            $this->getExpressionLabel($codeContext, $code)
        );
    }

    /**
     * Инициализация инструкции условия
     * @param CodeContext $codeContext код контекста
     * @param string $code псевдокод инструкции
     */
    protected function initCondition(CodeContext $codeContext, string $code): void
    {
        $this->setConditionLabel(
            $this->getExpressionLabel($codeContext, $code)
        );
    }

    /**
     * Инициализация инструкции каждого шага
     * @param CodeContext $codeContext код контекста
     * @param string $code псевдокод инструкции
     */
    protected function initEachStep(CodeContext $codeContext, string $code): void
    {
        $this->setEachStepLabel(
            $this->getExpressionLabel($codeContext, $code)
        );
    }

    /** Инициализация блока кода тела цикла
     * @param CodeContext $codeContext код контекста
     * @param string $code псевдькод блока кода
     * @throws CodeParseException
     */
    protected function initEachStepBlock(CodeContext $codeContext, string $code): void
    {
        $eachStepBlockCode = $this
            ->getBracketParser()
            ->parseFirstGroupContent(
                $code,
                BracketType::byValue(BracketType::BRACES)
            );
        $eachStepBlockLabel = $this
            ->createCodeBlock()
            ->setCode($eachStepBlockCode)
            ->parse($codeContext)
            ->getLabel();
        $this->setEachStepBlockLabel($eachStepBlockLabel);
    }
}