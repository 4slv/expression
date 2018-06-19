<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\Operation\OperationName;
use Slov\Expression\Operation\OperationSign;

/** Операция выражения в текстовом представлении */
class TextOperation
{
    /** @var OperationSign знак операции */
    protected $operationSign;

    /** @var OperationName название операции */
    protected $operationName;

    /** @var int номер позиции в выражении */
    protected $position;

    /**
     * @return OperationSign знак операции
     */
    public function getOperationSign(): OperationSign
    {
        return $this->operationSign;
    }

    /**
     * @param OperationSign $operationSign знак операции
     * @return $this
     */
    public function setOperationSign(OperationSign $operationSign)
    {
        $this->operationSign = $operationSign;
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
}