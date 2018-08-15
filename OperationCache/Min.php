<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\Operation\MinOperation;
use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\Extremum;
use Slov\Expression\OperationCache\Traits\OperandCode;
use Slov\Expression\TemplateProcessor\MultiplyTemplate;

class Min extends MinOperation implements OperationCache
{


    use MultiplyTemplate;

    use OperandCode;

    use Extremum;

    const subTemplateFolder = "min";

    const templateFolder = "operation";


}