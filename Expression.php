<?php

namespace Slov\Expression;

use Slov\Expression\Operation\Operation;
use Slov\Expression\Type\TypeName;

/** Выражение */
class Expression implements CodeToPhp
{
    use CodeAccessor;

    const FIRST_OPERAND = '%first_operand%';

    const SECOND_OPERAND = '%second_operand%';

    const OPERATION = '%operation%';

    /** @var Operand|null первый операнд */
    private $firstOperand;

    /** @var Operand|null второй операнд */
    private $secondOperand;

    /** @var Operation операция */
    private $operation;

    /** @var string php код */
    private $phpCode;

    /** @var bool флаг использования скобок */
    private $useBrackets = false;

    /** @var TypeName тип результата выражения */
    private $typeName;

    /**
     * @return Operand|null первый операнд
     */
    public function getFirstOperand(): ?Operand
    {
        return $this->firstOperand;
    }

    /**
     * @param Operand|null $firstOperand первый операнд
     * @return $this
     */
    public function setFirstOperand(?Operand $firstOperand)
    {
        $this->firstOperand = $firstOperand;
        return $this;
    }

    /**
     * @return Operand|null второй операнд
     */
    public function getSecondOperand(): ?Operand
    {
        return $this->secondOperand;
    }

    /**
     * @param Operand|null $secondOperand второй операнд
     * @return $this
     */
    public function setSecondOperand(?Operand $secondOperand)
    {
        $this->secondOperand = $secondOperand;
        return $this;
    }

    /**
     * @return Operation операция
     */
    public function getOperation(): Operation
    {
        return $this->operation;
    }

    /**
     * @param Operation $operation операция
     * @return $this
     */
    public function setOperation(Operation $operation)
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return bool
     */
    public function getUseBrackets(): bool
    {
        return $this->useBrackets;
    }

    /**
     * @param bool $useBrackets
     * @return $this
     */
    public function setUseBrackets(bool $useBrackets)
    {
        $this->useBrackets = $useBrackets;
        return $this;
    }

    /**
     * @return TypeName тип результата выражения
     */
    public function getTypeName(): TypeName
    {
        return $this->typeName;
    }

    /** Инициализация выражения
     * @return $this */
    public function init()
    {
        $this->typeName = $this->resolveReturnTypeName();
        return $this;
    }

    /**
     * @param string|null $code псевдо код
     * @return string php код
     */
    public function toPhp($code = null)
    {
        if(isset($code) || is_null($this->phpCode))
        {
            $this->setCode($code);
            $firstOperand = $this->getFirstOperand();
            $secondOperand = $this->getSecondOperand();
            $operation = $this
                ->getOperation()
                ->setFirstOperand($firstOperand)
                ->setSecondOperand($secondOperand);
            $this->phpCode = str_replace(
                [
                    self::FIRST_OPERAND,
                    self::OPERATION,
                    self::SECOND_OPERAND
                ],
                [
                    $firstOperand->toPhp($firstOperand->getCode()),
                    $operation->toPhp($operation->getCode()),
                    $secondOperand->toPhp($secondOperand->getCode())
                ],
                $operation->getPhpTemplate()
            );
        }
        return $this->getUseBrackets()
            ? '('. $this->phpCode. ')'
            : $this->phpCode;
    }

    /**
     * @return TypeName возвращаемый тип
     */
    private function resolveReturnTypeName()
    {
        return $this->getOperation()->resolveReturnTypeName();
    }
}