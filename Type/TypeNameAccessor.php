<?php

namespace Slov\Expression\Type;

/** Доступ к имени типа */
trait TypeNameAccessor
{
    /** @var TypeName имя типа */
    protected $typeName;

    /** @return TypeName имя типа */
    public function getTypeName(): TypeName
    {
        return $this->typeName;
    }

    /** @param TypeName $typeName имя типа
     * @return $this */
    protected function setTypeName(TypeName $typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }
}