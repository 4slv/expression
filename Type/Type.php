<?php

namespace Slov\Expression\Type;

use Slov\Expression\Calculation;
use Slov\Expression\Interfaces\Operand;
use Slov\Expression\TextExpression\VariableStructure;
use Slov\Money\Money;
use DateTime;
use DateInterval;


abstract class Type implements \Slov\Expression\Type\Interfaces\Type, Calculation {

    /** @var int|float|Money|DateTime|DateInterval|VariableStructure */
    protected $value;

    /**
     * @return $this
     */
    public function calculate()
    {
        return $this;
    }

}