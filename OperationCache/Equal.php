<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\EqualOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\Comparison;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;

class Equal extends EqualOperation implements OperationCache
{
    use PhpValues;

    use OperandCode;

    use MultiplyTemplate;

    use Comparison;

    const subTemplateFolder = 'equal';

    const templateFolder = 'operation';



}