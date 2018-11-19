<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeParseException;


/** Приоритетная операция */
class PriorityOperationFinder
{
    use OperationSignRegexpAccessor;

    /** Поиск наиболее приоритетной операции
     * @param string $expressionCode псевдо код выражения без скобок
     * @return string код наиболее приоритетной операции
     * @throws CodeParseException */
    public function find(string $expressionCode): string
    {
        $maxOperationInfo = null;
        foreach ($this->getOperationInfoList($expressionCode) as $operationInfo)
        {
            if(isset($maxOperationInfo)){
                /** @var OperationInfo $maxOperationInfo */
                if($operationInfo->grater($maxOperationInfo)){
                    $maxOperationInfo = $operationInfo;
                }
            } else {
                $maxOperationInfo = $operationInfo;
            }
        }
        return $this->getOperationCodeByPosition(
            $maxOperationInfo->getPosition(),
            $expressionCode
        );
    }

    /**
     * @param string $expressionCode псевдо код выражения без скобок
     * @return OperationInfo[] список информации об операции
     * @throws CodeParseException
     */
    private function getOperationInfoList(string $expressionCode)
    {
        $operationInfoList = [];
        foreach ($this->getOperationList($expressionCode) as $position => $sign)
        {
            $operationInfoList[] = $this->createOperationInfo($sign, $position);
        }
        return $operationInfoList;
    }

    /** Получение псевдокода операции по порядковому номеру
     * @param int $position порядковый номер позиции операции
     * @param string $expressionCode псевдо код выражения без скобок
     * @return string псевдокод операции */
    private function getOperationCodeByPosition(int $position, string $expressionCode): string
    {
        $operationList = $this->getOperationList($expressionCode);
        $operandList = $this->getOperandList($expressionCode);

        return count($operandList)
            ?   $operandList[$position].
                $operationList[$position].
                $operandList[$position + 1]

            :   $operandList[$position];
    }

    /**
     * @param string $operationSign псевдокод знака операции
     * @param int $position позиция в выражении
     * @return OperationInfo информация об операции
     * @throws CodeParseException
     */
    private function createOperationInfo($operationSign, $position)
    {
        $operationName = OperationSignRegexp::getOperationName($operationSign);
        $operationInfo = new OperationInfo();
        return $operationInfo
            ->setSign($operationSign)
            ->setOperationName($operationName)
            ->setPosition($position);
    }

    /**
     * @return string регулярное выражение выбирающее операции
     */
    private function getOperationListRegexp()
    {
        $signListRegexp = implode('|', $this->getOperationSignRegexpList());
        $operationListRegexp = '#('. $signListRegexp. ')#';
        return $operationListRegexp;
    }

    /**
     * @param string $expressionCode псевдо код выражения без скобок
     * @return string[] список псевдо кодов знаков операций
     */
    private function getOperationList($expressionCode)
    {
        preg_match_all($this->getOperationListRegexp(), $expressionCode, $match);
        return $match[0];
    }

    /**
     * @param string $expressionText псевдо код выражения без скобок
     * @return string[]
     */
    private function getOperandList($expressionText)
    {
        return preg_split($this->getOperationListRegexp(), $expressionText);
    }
}