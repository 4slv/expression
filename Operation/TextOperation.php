<?php

namespace Slov\Expression\Operation;


/** Операция выражения в текстовом представлении */
class TextOperation
{
    /** @var string текстовое представление операции */
    protected $operationValue;

    /** @var OperationName название операции */
    protected $operationName;

    /** @var int номер позиции в выражении */
    protected $position;

    /**
     * @return string тестовое представление операции
     */
    public function getOperationValue(): string
    {
        return $this->operationValue;
    }

    /**
     * @param string $operationValue тестовое представление операции
     * @return $this
     */
    public function setOperationValue(string $operationValue)
    {
        $this->operationValue = $operationValue;
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
     * @return int номер позиции в выражении
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position номер позиции в выражении
     * @return $this
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @param TextOperation $textOperation текстовая операция
     * @return bool true - текущая операция больше чем сравниваемая
     */
    public function grater($textOperation)
    {
        $thisOperationPriority = $this->getOperationName()->getPriority();
        $operationPriority = $textOperation->getOperationName()->getPriority();
        $thisOperationPosition = $this->getPosition();
        $operationPosition = $textOperation->getPosition();
        if($thisOperationPriority === $operationPriority)
        {
            if($thisOperationPosition === $operationPosition)
            {
                return false;
            }
            return $thisOperationPosition > $operationPosition;
        }
        return $thisOperationPriority > $operationPriority;
    }
}