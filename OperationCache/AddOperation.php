<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;

class AddOperation extends  \Slov\Expression\Operation\AddOperation implements OperationCache
{
    use PhpValues;
}