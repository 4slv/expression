<?php

namespace Slov\Expression;

use Slov\Expression\Type\Type;

interface Calculation {

    /**
     * @return Type
     * @throws CalculationException
     */
    public function calculate();
}
