<?php

namespace Slov\Expression;

use Slov\Expression\TextExpression\ExpressionList;
use Slov\Expression\Type\ExpressionType;
use Slov\Expression\Type\TypeFactory;
use Slov\Expression\Type\TypeNameFactory;
use Slov\Expression\Type\TypeRegExp;
use Slov\Expression\Type\TypeName;

/** Операнд */
class Operand implements CodeToPhp
{
    use CodeAccessor;

    /** @var TypeName  */
    protected $typeName;

    /** @var ExpressionList список выражений */
    protected $expressionList;

    /**
     * @return ExpressionList список выражений
     */
    public function getExpressionList(): ExpressionList
    {
        return $this->expressionList;
    }

    /**
     * @param ExpressionList $expressionList список выражений
     * @return $this
     */
    public function setExpressionList(ExpressionList $expressionList)
    {
        $this->expressionList = $expressionList;
        return $this;
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
            $type->setExpressionList($this->getExpressionList());
        }
        return $type->toPhp($code);
    }

    /**
     * @param string|null $code псевдо-код операнда
     * @return TypeName
     */
    public function getTypeName($code = null)
    {
        try{
            return $this->typeName ?? TypeRegExp::getTypeNameByStringValue($code ?? $this->getCode());
        } catch (ExpressionException $exception){
            return TypeNameFactory::getInstance()->createNull();
        }
    }
}