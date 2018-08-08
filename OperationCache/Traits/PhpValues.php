<?php


namespace Slov\Expression\OperationCache\Traits;


trait PhpValues
{

    /** @var string результат рассчёта первого операнда */
    private $firstOperandCode;

    /** @var string результат рассчёта второго операнда */
    private $secondOperandCode;

    /**
     * @return string|null
     */
    public function getFirstOperandCode(): ?string
    {
        return $this->firstOperandCode;
    }

    /**
     * @param string $firstOperandCode
     * @return $this
     */
    public function setFirstOperandCode(?string $firstOperandCode)
    {
        $this->firstOperandCode = $firstOperandCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSecondOperandCode(): ?string
    {
        return $this->secondOperandCode;
    }

    /**
     * @param string $secondOperandCode
     * @return $this
     */
    public function setSecondOperandCode(?string $secondOperandCode)
    {
        $this->secondOperandCode = $secondOperandCode;
        return $this;
    }


    /**
     * @return string
     */
    public function generatePhpCode()
    {
        return $this->generatePhpValues($this->getFirstOperandCode(),$this->getSecondOperandCode(),$this->getFirstOperandType(),$this->getSecondOperandType());
    }

}