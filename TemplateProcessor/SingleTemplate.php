<?php


namespace Slov\Expression\TemplateProcessor;


trait SingleTemplate
{
    /**
     * @return bool|string
     */
    protected function getTemplate()
    {

        return TemplateProcessor::getInstance()
            ->getTemplateByName(static::template,[static::templateFolder]);
    }

    /**
     * @param array $variable
     * @return string
     */
    protected function render($variable = [])
    {
        return TemplateProcessor::getInstance()->render($this->getTemplate(),$variable);
    }
}