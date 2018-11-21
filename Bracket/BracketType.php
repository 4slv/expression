<?php

namespace Slov\Expression\Bracket;

use MabeEnum\Enum;

/** Тип скобки */
class BracketType extends Enum
{
    const BRACES = '{}';

    const SQUARE_BRACKETS = '[]';

    const ROUND_BRACKETS = '()';

    /**
     * @return string открывающая скобка
     */
    public function getOpenBracket()
    {
        $brackets = str_split($this->getValue());
        return current($brackets);
    }

    /**
     * @return string закрывающая скобка
     */
    public function getCloseBracket()
    {
        $brackets = str_split($this->getValue());
        end($brackets);
        return current($brackets);
    }
}