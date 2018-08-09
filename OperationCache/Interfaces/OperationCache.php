<?php

namespace Slov\Expression\OperationCache\Interfaces;

use Slov\Expression\Type\TypeName;

interface OperationCache
{
    /**
     * @return string
     */
    public function generatePhpCode();

    /**
     * @return TypeName
     */
    public function resolveReturnTypeName();

    /**
     * @return null|string
     */
    public function getFirstOperandCode(): ?string;

    /**
     * @param string $firstOperandCode
     * @return $this
     */
    public function setFirstOperandCode(?string $firstOperandCode);

    /**
     * @return string|null
     */
    public function getSecondOperandCode(): ?string;

    /**
     * @param string $secondOperandCode
     * @return $this
     */
    public function setSecondOperandCode(?string $secondOperandCode);

}