<?php

namespace Slov\Expression\Operation;

use Slov\Expression\Code\CodeAccessor;
use Slov\Expression\Code\CodeParseException;


/** Поиск приоритетной операции */
class PriorityOperationFinder
{
    use CodeAccessor;
    use OperationSignRegexpAccessor;

    /** @var string[] список псевдокода знаков операций */
    protected $operationSignList;

    /** @var string[] список псевдокода операндов */
    protected $operandList;

    /**
     * @return string[] список псевдокода знаков операций
     */
    public function getOperationSignList(): array
    {
        return $this->operationSignList;
    }

    /**
     * @param string[] $operationSignList список псевдокода знаков операций
     * @return $this
     */
    protected function setOperationSignList(array $operationSignList)
    {
        $this->operationSignList = $operationSignList;
        return $this;
    }

    /**
     * @return string[] список псевдокода операндов
     */
    public function getOperandList(): array
    {
        return $this->operandList;
    }

    /**
     * @param string[] $operandList список псевдокода операндов
     * @return $this
     */
    protected function setOperandList(array $operandList)
    {
        $this->operandList = $operandList;
        return $this;
    }

    /** @param string $expressionCode псевдо код выражения без скобок */
    public function __construct(string $expressionCode)
    {
        $this->init($expressionCode);
    }

    /**
     * @param string $expressionCode псевдо код выражения без скобок
     * @return $this
     */
    public function init(string $expressionCode)
    {
        return $this
            ->setCode($expressionCode)
            ->setOperandList($this->createOperandList($expressionCode))
            ->setOperationSignList($this->createOperationSignList($expressionCode));
    }

    /** Поиск наиболее приоритетной операции
     * @return string код наиболее приоритетной операции
     * @throws CodeParseException */
    public function find(): string
    {
        $maxOperationInfo = null;
        foreach ($this->getOperationInfoList() as $operationInfo)
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
        return $this->getOperationCodeByPosition($maxOperationInfo->getPosition());
    }

    /**
     * @return OperationInfo[] список информации об операции
     * @throws CodeParseException
     */
    private function getOperationInfoList()
    {
        $operationInfoList = [];
        foreach ($this->getOperationSignList() as $position => $sign)
        {
            $operationInfoList[] = $this->createOperationInfo($sign, $position);
        }
        return $operationInfoList;
    }

    /** Получение псевдокода операции по порядковому номеру
     * @param int $position порядковый номер позиции операции
     * @return string псевдокод операции */
    private function getOperationCodeByPosition(int $position): string
    {
        $operationList = $this->getOperationSignList();
        $operandList = $this->getOperandList();

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
    private function createOperationSignList($expressionCode)
    {
        preg_match_all($this->getOperationListRegexp(), $expressionCode, $match);
        return $match[0];
    }

    /**
     * @param string $expressionText псевдо код выражения без скобок
     * @return string[] список операндов
     */
    private function createOperandList($expressionText)
    {
        return preg_split($this->getOperationListRegexp(), $expressionText);
    }
}