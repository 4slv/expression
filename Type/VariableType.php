<?php

namespace Slov\Expression\Type;

use Slov\Expression\Expression;
use Slov\Expression\ExpressionCache;
use Slov\Expression\TextExpression\VariableList;
use Slov\Expression\Type\Interfaces\CacheVariable;

/** Тип переменной */
class VariableType extends Type implements CacheVariable
{
    /** @var VariableList список переменных */
    private $variableList;

    /**
     * @return VariableList список переменных
     */
    public function getVariableList(): VariableList
    {
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
     * @return TypeName
     */
    function getType(): TypeName
    {
        return new TypeName(TypeName::VARIABLE);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this;
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $string строковое представление переменной
     * @return string
     */
    public function stringToValue($string): string
    {
        return ltrim($string, '$');
    }

    public function calculate()
    {
        if($this->getVariableList()->exists($this->getValue()))
        {
            $variable = $this->getVariableList()->get($this->getValue());
            if($variable instanceof Expression)
            {
                return $variable->calculate();
            }
            return $variable;
        } else {
            return $this;
        }
    }

    public function generatePhpCode(): string
    {
        if($this->getVariableList()->exists($this->getValue()))
        {
            $variable = $this->getVariableList()->get($this->getValue());
            if($variable instanceof ExpressionCache) {
                return $variable->generatePhpCode();
            }
            return $variable->generatePhpCode();
        } else {
            return "$$this->getValue()";
        }
    }


}