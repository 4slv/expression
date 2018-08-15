<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\GreaterOrEqualOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\Comparison;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;

class GreaterOrEqual extends GreaterOrEqualOperation  implements OperationCache
{
    use PhpValues;

    use MultiplyTemplate;

    use Comparison;

    use OperandCode;

    const subTemplateFolder = 'greater_or_equal';

    const templateFolder = 'operation';

}