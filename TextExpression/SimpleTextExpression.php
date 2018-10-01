<?php

namespace Slov\Expression\TextExpression;

use Slov\Expression\SimpleTextExpressionToPhp;
use Slov\Expression\StringToPhp;

/** Выражение в текстовом представлении без скобок */
class SimpleTextExpression implements StringToPhp
{

    /** @var string php - код */
    protected $phpCode;

    /**
     * @return SimpleTextExpressionToPhp преобразователь псевдо-кода в php код
     */
    public function createSimpleTextExpressionToPhp()
    {
        return new SimpleTextExpressionToPhp();
    }


    public function toPhp($code)
    {
        $this->phpCode = $this
            ->createSimpleTextExpressionToPhp()
            ->toPhp($code);
        return eval('return '. $this->phpCode. ';');
    }
}