<?php

namespace Slov\Expression;

/** Преобразователь псевдо-кода в php код */
interface StringToPhp
{
    /**
     * @param string $code пседо-код
     * @return string php-код
     */
    public function toPhp($code);
}