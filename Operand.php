<?php

namespace Slov\Expression;


use Slov\Expression\Expression\ExpressionException;
use Slov\Expression\Type\ExpressionType;
use Slov\Expression\Type\TypeFactory;
use Slov\Expression\Type\TypeNameFactory;
use Slov\Expression\Type\TypeRegExp;
use Slov\Expression\Type\TypeName;

/** Операнд */
class Operand implements ToPhpTransformer
{
    use CodeAccessorTrait,
        CodeContextAccessor;

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

    public function toPhp(string $code, CodeContext $codeContext): string
    {
        $typeName = $this->getTypeName($code);
        $type = TypeFactory::getInstance()->create($typeName);

        if($typeName->isExpression())
        {
            /** @var ExpressionType $type */
            $type->setCodeContext($this->getCodeContext());
            $operandExpression = $this->getExpressionList()->get($code);
            $type->setTypeName($operandExpression->getTypeName());
        }
        return $type->toPhp($code, $codeContext);
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