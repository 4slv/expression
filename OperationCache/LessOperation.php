<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;

class LessOperation extends \Slov\Expression\Operation\LessOperation implements OperationCache
{
    use PhpValues;

}