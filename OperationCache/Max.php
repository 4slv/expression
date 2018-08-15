<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\MaxOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\Extremum;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;

class Max extends MaxOperation implements OperationCache
{


    use MultiplyTemplate;

    use OperandCode;

    use Extremum;

    const subTemplateFolder = "max";

    const templateFolder = "operation";


}