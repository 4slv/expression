<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\OrOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\Logical;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;

class LogicalOr extends OrOperation implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

    use Logical;

    use OperandCode;

    const template = 'or';

    const templateFolder = 'operation';

}