<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\ExpressionException;
use Slov\Expression\Operation\OperationSignRegexp;
use Slov\Expression\Type\TypeName;
use Slov\Expression\Type\TypeRegExp;
use Slov\Expression\FactoryRepository;
use Slov\Expression\Expression;

/** Выражение в текстовом представлении */
class TextExpression
{
    use FactoryRepository;

    const SUB_EXPRESSION_REGEXP = '/\(([^\(\)]+)\)/';

    /** @var ExpressionList список выражений */
    protected $expressionList;

    /** @var VariableList список переменных */
    protected $variableList;

    /** @var FunctionList список функций */
    protected $functionList;

    /** @var string выражение в текстовом представлении */
    protected $expressionText;

    /**
     * @return ExpressionList список выражений
     */
    public function getExpressionList()
    {
        if(is_null($this->expressionList))
        {
            $this->expressionList = new ExpressionList();
        }
        return $this->expressionList;
    }

    /**
     * @param ExpressionList $expressionList список выражений
     * @return $this
     */
    public function setExpressionList($expressionList)
    {
        $this->expressionList = $expressionList;
        return $this;
    }

    /**
     * @return VariableList список переменных
     */
    public function getVariableList(): VariableList
    {
        if(is_null($this->variableList))
        {
            $this->variableList = new VariableList();
        }
        return $this->variableList;
    }

    /**
     * @param VariableList $variableList список переменных
     * @return $this
     */
    public function setVariableList(VariableList $variableList)
    {
        $this->variableList = $variableList;
        return $this;
    }

    /**
     * @return FunctionList список функций
     */
    public function getFunctionList(): FunctionList
    {
        if(is_null($this->functionList)){
            $this->functionList = new FunctionList();
        }
        return $this->functionList;
    }

    /**
     * @param FunctionList $functionList список функций
     * @return $this
     */
    public function setFunctionList(FunctionList $functionList)
    {
        $this->functionList = $functionList;
        return $this;
    }

    /**
     * @return string выражение в текстовом представлении
     */
    public function getExpressionText(): string
    {
        return $this->expressionText;
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return $this
     */
    public function setExpressionText(string $expressionText)
    {
        $this->expressionText = $expressionText;
        return $this;
    }

    /**
     * @return Expression выражение
     * @throws ExpressionException
     */
    public function toExpression()
    {
        return $this->createExpressionFromTextExpression($this->getExpressionText());
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return SimpleTextExpression выражение в текстовом представлении без скобок
     */
    protected function createSimpleTextExpression($expressionText)
    {
        $simpleTextExpression = new SimpleTextExpression();
        return $simpleTextExpression
            ->setExpressionText($expressionText)
            ->setExpressionList($this->getExpressionList())
            ->setVariableList($this->getVariableList())
            ->setFunctionList($this->getFunctionList());
    }

    /** Добавление выражения в список
     * @param Expression $expression выражение
     * @return string текстовая метка выражения
     */
    protected function appendExpression(Expression $expression)
    {
        $expressionNumber = $this->expressionList->size();
        $expressionName = TypeName::EXPRESSION . $expressionNumber;
        $this->expressionList->append($expressionName, $expression);
        return $expressionName;
    }

    /**
     * @param string $expressionText текстовая метка выражения
     * @return Expression выражение
     */
    protected function getExpressionByText($expressionText)
    {
        return $this->getExpressionList()->get($expressionText);
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return Expression выражение
     * @throws ExpressionException
     */
    private function createExpressionFromTextExpression($expressionText)
    {
        $simpleTextExpressionList = $this->getSimpleTextExpressionList($expressionText);
        $simpleTextExpressionBracketedList = $this->getSimpleTextExpressionBracketedList($expressionText);

        if (count($simpleTextExpressionList) === 0) {
            return $this->createSimpleTextExpression($expressionText)->toExpression();
        } else {
            foreach($simpleTextExpressionList as $position => $simpleTextExpression) {
                $simpleTextExpressionBracketed = $simpleTextExpressionBracketedList[$position];
                $expressionTextWithLabel = $this->replaceExpressionText(
                    $expressionText, $simpleTextExpressionBracketed
                );
                return $this->createExpressionFromTextExpression($expressionTextWithLabel);
            }
        }
    }

    /**
     * @param string $expressionText выражение в текстовом представлении с обрамляющими скобками
     * @return string выражение в текстовом представлении без обрамляющих скобок
     */
    public function removeBracket($expressionText)
    {
        $firstLetter = substr($expressionText, 0, 1);
        $lastLetter = substr($expressionText, -1, 1);
        return $firstLetter === '(' && $lastLetter === ')'
            ? substr($expressionText, 1, -1)
            : $expressionText;
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @param string $simpleTextExpressionBracketed подвыражение в текстовом представлении (со скобками)
     * @return string
     * @throws ExpressionException
     */
    private function replaceExpressionText($expressionText, $simpleTextExpressionBracketed)
    {
        $simpleTextExpression = $this->removeBracket($simpleTextExpressionBracketed);
        $expression = $this->createSimpleTextExpression($simpleTextExpression)->toExpression();
        $expressionLabel = $this->appendExpression($expression);
        $replaceSize = 1;
        return str_replace(
            $simpleTextExpressionBracketed, $expressionLabel, $expressionText,$replaceSize
        );
    }

    /**
     * @return string[] список экранированных символов операций для регулярного выражения
     */
    protected function getRegexpSignList()
    {
        $signRegexpList = OperationSignRegexp::toArray();
        /* @var string[] $signRegexpList */
        return $signRegexpList;
    }

    /**
     * @return string регулярное выражение выбирающее операции
     */
    protected function getOperationListRegexp()
    {
        $signListRegexp = implode('|', $this->getRegexpSignList());
        $operationListRegexp = '#('. $signListRegexp. ')#';
        return $operationListRegexp;
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return string[] список операций
     */
    protected function getOperationList($expressionText)
    {
        preg_match_all($this->getOperationListRegexp(), $expressionText, $match);
        return $match[0];
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return string[]
     */
    protected function getOperandList($expressionText)
    {
        return preg_split($this->getOperationListRegexp(), $expressionText);
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return string[]
     */
    protected function getTrimOperandList($expressionText)
    {
        return array_map(
            function($operand){
                return trim($operand);
            },
            $this->getOperandList($expressionText)
        );
    }

    /**
     * @return string[] список регулярных выражений типов
     */
    protected function getTypeRegexpList()
    {
        $regexpList = TypeRegExp::values();
        /* @var string[] $regexpList */
        return $regexpList;
    }

    /**
     * @param string $operandValue значение опреанда
     * @return TypeName название типа
     * @throws ExpressionException
     */
    protected function getOperandType($operandValue)
    {
        return TypeRegExp::getTypeNameByStringValue($operandValue);
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return string[] список подвыражений (без скобок) в текстовом предсавлении
     */
    protected function getSimpleTextExpressionList($expressionText)
    {
        preg_match_all(self::SUB_EXPRESSION_REGEXP, $expressionText, $match);
        return $match[1];
    }

    /**
     * @param string $expressionText выражение в текстовом представлении
     * @return string[] список подвыражений (без скобок) в текстовом предсавлении (обрамленных скобками)
     */
    protected function getSimpleTextExpressionBracketedList($expressionText)
    {
        preg_match_all(self::SUB_EXPRESSION_REGEXP, $expressionText, $match);
        return $match[0];
    }
}