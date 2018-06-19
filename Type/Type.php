<?php

namespace Slov\Expression\Type;

use Slov\Expression\Calculation;
use Slov\Money\Money;
use DateTime;
use DateInterval;


abstract class Type implements TypeInterface, Calculation {

    /** @var int|float|Money|DateTime|DateInterval */
    protected $value;

    /**
     * @return $this
     */
    public function calculate()
    {
        return $this;
    }

}