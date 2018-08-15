<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\CalculationException;
use Slov\Expression\Operation\LessOrEqualOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\Comparison;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;
use Slov\Expression\Type\TypeName;

class LessOrEqual extends LessOrEqualOperation  implements OperationCache
{
    use PhpValues;

    use MultiplyTemplate;

    use Comparison;

    use OperandCode;

    const subTemplateFolder = 'less_or_equal';

    const templateFolder = 'operation';


}