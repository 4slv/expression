<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traits\PhpValues;

class SubtractionOperation extends \Slov\Expression\Operation\SubtractionOperation implements OperationCache
{
    use PhpValues;

}