<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\LessOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\Comparison;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;

class Less extends LessOperation implements OperationCache
{
    use PhpValues;

    use MultiplyTemplate;

    use Comparison;

    use OperandCode;

    const subTemplateFolder = 'less';

    const templateFolder = 'operation';


}