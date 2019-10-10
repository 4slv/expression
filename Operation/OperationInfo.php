<?php

namespace Slov\Expression\Operation;

/** Информация об операции */
class OperationInfo
{
    /** @var string псевдо код знака операции */
    protected $sign;

    /** @var OperationName название операции */
    protected $operationName;

    /** @var int номер позиции операции в выражении (без скобок) */
    protected $position;

    /**
     * @return string псевдо код знака операции
     */
    public function getSign(): string
    {
        return $this->sign;
    }

    /**
     * @param string $sign псевдо код знака операции
     * @return $this
     */
    public function setSign(string $sign)
    {
        $this->sign = $sign;
        return $this;
    }

    /**
     * @return OperationName название операции знак операции
     */
    public function getOperationName(): OperationName
    {
        return $this->operationName;
    }

    /**
     * @param OperationName $operationName название операции
     * @return $this
     */
    public function setOperationName(OperationName $operationName)
    {
        $this->operationName = $operationName;
        return $this;
    }

    /**
     * @return int номер позиции операции в выражении (без скобок)
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position номер позиции операции в выражении (без скобок)
     * @return $this
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @param OperationInfo $operationInfo текстовая операция
     * @return bool true - текущая операция больше чем сравниваемая
     */
    public function grater($operationInfo)
    {
        $thisOperationPriority = $this->getOperationName()->getPriority();
        $operationPriority = $operationInfo->getOperationName()->getPriority();
        $thisOperationPosition = $this->getPosition();
        $operationPosition = $operationInfo->getPosition();
        if($thisOperationPriority === $operationPriority)
        {
            if($thisOperationPosition === $operationPosition)
            {
                return false;
            }
            return $thisOperationPosition < $operationPosition;
        }
        return $thisOperationPriority > $operationPriority;
    }
}