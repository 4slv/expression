<?php


namespace Slov\Expression\OperationCache\Traits;


use Slov\Expression\Type\TypeName;

trait Logical
{
    /**
     * @return string
     */
    public function resolveReturnTypeName(){
        return TypeName::BOOLEAN();
    }

    /**
     * @param string $firstValue
     * @param string $secondValue
     * @param TypeName $firstType
     * @param TypeName $secondType
     * @return string
     */
    protected function generatePhpValues(string $firstValue, string $secondValue, TypeName $firstType, TypeName $secondType)
    {
        return $this->render(compact('firstValue', 'secondValue'));
    }

}