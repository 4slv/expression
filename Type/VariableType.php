<?php

namespace Slov\Expression\Type;

use Slov\Expression\Expression;
use Slov\Expression\ExpressionCache;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;
use Slov\Expression\TextExpression\Config;
use Slov\Expression\TextExpression\VariableList;
use Slov\Expression\Type\Interfaces\CacheVariable;
use Slov\Helper\StringHelper;

/** Тип переменной */
class VariableType extends Type implements CacheVariable
{
    use MultiplyTemplate;
    /** @var VariableList список переменных */
    private $variableList;

    /** @var  TypeName */
    private $typeName;

    const subTemplateFolder = 'variable';

    const templateFolder = 'type';



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
    public function getType(): TypeName
    {
        if(is_null($this->typeName))
            $this->typeName = new TypeName(TypeName::VARIABLE);
        return $this->typeName;
    }

    /**
     * @param TypeName $typeName
     * @return $this
     */
    public function setType(TypeName $typeName)
    {
        $this->typeName = $typeName;
        return $this;
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
            $this->setType($variable->getType());
            if($variable instanceof ExpressionCache) {
                return
                Config::getInstance()->isExpressionAsSingleMethod()
                ? $this->render('expression_closure',['code' => $variable->generatePhpCode()])
                : $this->render('expression_file',[
                    'function_name' => $variable->createExpressionCacheFile()->getFunctionName(),
                    'class_name' => $variable->createExpressionCacheFile()->getClassName(),
                ]);
            }
            return $this->render('variable_list',['name' => $this->getValue()]);
        } else {
           // dump( $this);exit;
            return $this->render('variable_list',['name' => $this->getValue()]);
        }
    }


}