<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\AndOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\Logical;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\OperationCache\Traits\PhpValues;
use Slov\Expression\TemplateProcessor\SingleTemplate;

class LogicalAnd extends AndOperation implements OperationCache
{
    use PhpValues;

    use SingleTemplate;

    use Logical;

    use OperandCode;

    const template = 'and';

    const templateFolder = 'operation';


}