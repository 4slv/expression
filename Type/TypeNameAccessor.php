<?php

namespace Slov\Expression\Type;


trait TypeNameAccessor
{
    /** @var TypeName название типа */
    private $typeName;

    /**
     * @return TypeName название типа
     */
    public function getTypeName(): TypeName
    {
        return $this->typeName;
    }

    /**
     * @param TypeName $typeName название типа
     * @return $this
     */
    public function setTypeName(TypeName $typeName)
    {
        $this->typeName = $typeName;
        return $this;
    }


}