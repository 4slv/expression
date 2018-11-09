<?php

namespace Slov\Expression\Expression;

use Slov\Expression\Code\CodeContext;
use Slov\Expression\Code\CodeConverter;
use Slov\Expression\Code\CodeParseException;
use Slov\Expression\Operation\OperationName;
use Slov\Expression\Operation\OperationParseInfo;
use Slov\Expression\Operation\OperationSign;
use Slov\Expression\Operation\OperationSignRegexp;

/** Преобразователь простого выражения (без скобок), пример простого выражения: 1 + 1 */
class SimpleExpressionConverter extends CodeConverter
{
    /**
     * @param string $code
     * @param CodeContext $context
     * @return string
     * @throws CodeParseException
     */
    protected function parse(string $code, CodeContext $context): string
    {
        $operationList = $this->getOperationList($code);
        if(count($operationList) > 0){
            $textOperationList = [];
            foreach($operationList as $operationPosition => $operationSign){
                $textOperationList[] = $this->createOperationParseInfo($operationSign, $operationPosition);
            }
            $maxTextOperation = $this->getMaxTextOperation($textOperationList);
            $operandList = $this->getTrimOperandList($code);
            $replacedCode = $this->replaceExpressionText($maxTextOperation, $operationList, $operandList);
            return $this->parse($replacedCode, $context);
        } else {
            return $code;
        }
    }

    /**
     * @param string $code псевдо код
     * @return string[] список операций
     */
    protected function getOperationList($code)
    {
        preg_match_all($this->getOperationListRegexp(), $code, $match);
        return $match[0];
    }

    /**
     * @param string $code псевдо код
     * @return string[] список операндов
     */
    protected function getOperandList($code)
    {
        return preg_split($this->getOperationListRegexp(), $code);
    }

    /**
     * @param string $code псевдо код
     * @return string[] список операндов очищенных от пробелов
     */
    protected function getTrimOperandList($code)
    {
        return array_map(
            function($operand){
                return trim($operand);
            },
            $this->getOperandList($code)
        );
    }

    /**
     * @return string регулярное выражение выбирающее операции
     */
    protected function getOperationListRegexp()
    {
        $signListRegexp = implode('|', OperationSignRegexp::getConstants());
        $operationListRegexp = '#('. $signListRegexp. ')#';
        return $operationListRegexp;
    }

    /**
     * @param string $operationValue текстовое представление операции
     * @param int $position позиция в выражении
     * @return OperationParseInfo информация об операции при синтаксическом разборе
     * @throws CodeParseException
     */
    protected function createOperationParseInfo($operationValue, $position)
    {
        $operationSignValue = $this->getOperationSignValue($operationValue);
        $operationSign = OperationSign::byValue($operationSignValue);
        $operationKey = $operationSign->getName();
        $operationNameValue = constant(OperationName::class. '::'. $operationKey);
        $operationName = OperationName::byValue($operationNameValue);
        $textOperation = new OperationParseInfo();
        return $textOperation
            ->setOperationValue($operationValue)
            ->setOperationSign($operationSign)
            ->setOperationName($operationName)
            ->setPosition($position);
    }

    /**
     * @param string $operationValue текстовое представление операции
     * @return string знак операции
     * @throws CodeParseException
     */
    protected function getOperationSignValue($operationValue)
    {
        foreach(OperationSignRegexp::getConstants() as $signKey => $signRegExp)
        {
            if(preg_match('/^'. $signRegExp. '$/', $operationValue)){
                return constant(OperationSign::class . '::'. $signKey);
            }
        }
        throw new CodeParseException('Unknown operation: '. $operationValue);
    }

    /**
     * @param OperationParseInfo[] $operationParseInfoList список информации по операциям
     * @return OperationParseInfo максимальная по приоритету и позиции текстовая операция
     */
    protected function getMaxTextOperation($operationParseInfoList)
    {
        $sortedTextOperationList = $this->sortTextOperationList($operationParseInfoList);
        return array_pop($sortedTextOperationList);
    }

    /**
     * @param OperationParseInfo[] $operationParseInfoList список информации по операциям
     * @return OperationParseInfo[] отсортированный по приоритету и позиции список операций
     */
    protected function sortTextOperationList($operationParseInfoList)
    {
        usort(
            $operationParseInfoList,
            function(OperationParseInfo $leftOperation, OperationParseInfo $rightOperation)
            {
                $leftOperationPriority = $leftOperation->getOperationName()->getPriority();
                $rightOperationPriority = $rightOperation->getOperationName()->getPriority();
                $leftOperationPosition = $leftOperation->getPosition();
                $rightOperationPosition = $rightOperation->getPosition();
                if($leftOperationPriority === $rightOperationPriority)
                {
                    if($leftOperationPosition === $rightOperationPosition)
                    {
                        return 0;
                    }
                    return $leftOperationPosition > $rightOperationPosition ? -1 : 1;
                }
                return $leftOperationPriority < $rightOperationPriority ? -1 : 1;
            }
        );
        return $operationParseInfoList;
    }

    /**
     * @param OperationParseInfo $textOperation операция выражения в текстовом представлении
     * @param string[] $operationSignList список знаков операций
     * @param string[] $operandList список операндв операций
     * @return string текстовое представление выражения в котом заменена одна операция на метку с выражением
     * @throws CodeParseException
     */
    private function replaceExpressionText(OperationParseInfo $textOperation, $operationSignList, $operandList)
    {
        $expression = $this->createExpressionFromOperationAndOperands($textOperation, $operandList);
        $expressionLabel = $this->appendExpression($expression);
        $operationPosition = $textOperation->getPosition();
        $operation = $textOperation->getOperationName();
        $expressionTextParts = [];
        foreach($operandList as $position => $operand){
            if(
                ($position !== $operationPosition || $operation->leftOperandUsed() === false)
                &&
                ($position !== $operationPosition + 1 || $operation->rightOperandUsed() === false)
            ) {
                $expressionTextParts[] = $operand;
            }
            if(array_key_exists($position, $operationSignList)){
                $operationSign = $operationSignList[$position];
                $expressionTextParts[] = $position === $operationPosition
                    ? $expressionLabel
                    : $operationSign;
            }
        }
        return implode('', $expressionTextParts);
    }
}