<?php

namespace Slov\Expression\Statement;


use MabeEnum\Enum;

/** Тип инструкции */
class StatementType extends Enum
{
    /** @var string инструкция вида: $i = 1; */
    const SIMPLE_STATEMENT = 'SimpleStatement';

    /** @var string условная инструкция вида: if($a > $b){ $i = 1; } */
    const IF_STATEMENT = 'IfStatement';

    /** @var string цикл вида: for($i = 1; $ i < 10; $i = $i + 1){ $a = $i * 2; } */
    const FOR_STATEMENT = 'ForStatement';
}