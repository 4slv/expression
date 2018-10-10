<?php

namespace Slov\Expression;

use Slov\Expression\TextExpression\ExpressionContextAccessor;
use Slov\Expression\Type\ExpressionType;
use Slov\Expression\Type\TypeFactory;
use Slov\Expression\Type\TypeNameFactory;
use Slov\Expression\Type\TypeRegExp;
use Slov\Expression\Type\TypeName;

/** Операнд */
class Operand implements CodeToPhp
{
    use CodeAccessor,
        ExpressionContextAccessor;

    /**
     * @param string $code псевдо-код операнда
     * @return TypeName тип операнда
     */
    public function getTypeName($code = null)
    {
        try {
            $operandCode = $code ?? $this->getCode();
            $operandTypeName = TypeRegExp::getTypeNameByStringValue($operandCode);
            return $operandTypeName;
        } catch (ExpressionException $exception){
            return TypeNameFactory::getInstance()->createNull();
        }
    }

    /**
     * @param string|null $code псевдо-код операнда
     * @return TypeName
     */
    public function getSimpleTypeName($code = null)
    {
        $operandCode = $code ?? $this->getCode();
        $typeName = $this->getTypeName($code);
        if($typeName->isVariable())
        {
            return $this
                ->getVariableList()
                ->get($this->getVariableName($operandCode))
                ->getTypeName();
        } elseif ($typeName->isExpression()) {
            return $this
                ->getExpressionList()
                ->get($operandCode)
                ->getTypeName();
        } else {
            return $typeName;
        }
    }

    /**
     * @param string $code псевдо код
     * @return string php код
     */
    public function toPhp($code)
    {
        $typeName = $this->getTypeName($code);
        $type = TypeFactory::getInstance()->create($typeName);

        if($typeName->isExpression())
        {
            /** @var ExpressionType $type */
            $type->setExpressionContext($this->getExpressionContext());
            $operandExpression = $this->getExpressionList()->get($code);
            $type->setTypeName($operandExpression->getTypeName());
        }
        return $type->toPhp($code);
    }

    /**
     * @param string $code псевдо-код операнда
     * @return string на
     */
    public function getVariableName($code)
    {
        return trim($code, '$= ');
    }
}