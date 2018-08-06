<?php

namespace Slov\Expression\OperationCache\Traites;

trait Templater
{

    public function getTemplate()
    {
        return file_get_contents($this->getTemplateDir().DIRECTORY_SEPARATOR.static::template);
    }

    public function getTemplateDir()
    {
        return implode(DIRECTORY_SEPARATOR,[ __DIR__,"..","templates"]);
    }
}