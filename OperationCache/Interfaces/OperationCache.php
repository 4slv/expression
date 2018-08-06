<?php

namespace Slov\Expression\OperationCache\Interfaces;

interface OperationCache
{
    public function generatePhpCode();

    public function getTemplate();
}