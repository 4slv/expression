<?php

namespace Slov\Expression\Operation;

use Slov\Expression\CalculationException;
use Slov\Expression\Expression;
use Slov\Expression\FactoryRepository;
use Slov\Expression\TextExpression\VariableList;
use Slov\Expression\Type\Type;
use Slov\Expression\Type\TypeInterface;
use Slov\Expression\Type\TypeName;

trait OperationTrait
{
    use FactoryRepository;

    /** @var TypeInterface первый операнд */
    protected $firstOperand;

    /** @var TypeInterface второй операнд */
    protected $secondOperand;

    /**
     * @return TypeInterface первый операнд
     */
    public function getFirstOperand(): TypeInterface
    {
        return $this->firstOperand;
    }

    /**
     * @param TypeInterface $firstOperand первый операнд
     * @return $this
     */
    public function setFirstOperand(TypeInterface $firstOperand)
    {
        $this->firstOperand = $firstOperand;
        return $this;
    }

    /**
     * @return TypeInterface второй операнд
     */
    public function getSecondOperand(): TypeInterface
    {
        return $this->secondOperand;
    }

    /**
     * @param TypeInterface $secondOperand второй операнд
     * @return $this
     */
    public function setSecondOperand(TypeInterface $secondOperand)
    {
        $this->secondOperand = $secondOperand;
        return $this;
    }

    /**
     * @return TypeName тип первого операнда
     */
    protected function getFirstOperandType()
    {
        return $this->getFirstOperand()->getType();
    }

    /**
     * @return TypeName тип второго операнда
     */
    protected function getSecondOperandType()
    {
        return $this->getSecondOperand()->getType();
    }

    /**
     * @return float|int значение первого операнда
     */
    protected function getFirstOperandValue()
    {
        return $this->getFirstOperand()->getValue();
    }

    /**
     * @return float|int значение второго операнда
     */
    protected function getSecondOperandValue()
    {
        return $this->getSecondOperand()->getValue();
    }

    /** Заполнение операндов нулевым значением в случае отсутствия */
    protected function fillOperandsZeroIfNull()
    {
        if($this->getFirstOperandType()->isNull()){
            $this->setFirstOperand($this->createZero());
        }
        if($this->getSecondOperandType()->isNull()){
            $this->setSecondOperand($this->createZero());
        }
    }

    /**
     * @return Type тип со значением
     * @throws CalculationException
     */
    public function calculate()
    {
        $this->fillOperandsZeroIfNull();
        $resultTypeName = $this->resolveReturnTypeName();
        if(is_null($resultTypeName)){
            $this->throwOperationException();
        }
        return $this->calculateType($resultTypeName);
    }

    /**
     * @throws CalculationException исключние о неподдерживающейся операции
     */
    protected function throwOperationException()
    {
        $operationName = static::getOperationName();
        $firstOperandType = $this->getFirstOperandType();
        $secondOperandType = $this->getSecondOperandType();
        throw new CalculationException(
            "Operation is not supported: $firstOperandType $operationName $secondOperandType"
        );
    }

    /**
     * @param TypeName $typeName название типа
     * @return Type
     */
    protected function calculateType(TypeName $typeName)
    {
        return $this
            ->getTypeFactory()
            ->create($typeName)
            ->setValue(
                $this->calculateValues(
                    $this->getFirstOperandValue(),
                    $this->getSecondOperandValue()
                )
            );
    }
}