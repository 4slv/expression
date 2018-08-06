<?php


namespace Slov\Expression\OperationCache;


use Slov\Expression\OperationCache\Interfaces\OperationCache;
use Slov\Expression\OperationCache\Traites\Templater;

class MultiplyOperation extends \Slov\Expression\Operation\MultiplyOperation implements OperationCache
{

    use Templater;

    public function generatePhpCode()
    {
        // TODO: Implement generatePhpCode() method.
    }

}