<?php


namespace Slov\Expression\TemplateProcessor;


trait MultiplyTemplate
{
    protected function getTemplate($name)
    {
        return TemplateProcessor::getInstance()
            ->getTemplateByName($name,[static::templateFolder,static::subTemplateFolder]);
    }

    /**
     * @param string $name
     * @param array $variable
     * @return string
     */
    protected function render(string $name, $variable = [])
    {
        return TemplateProcessor::getInstance()->render($this->getTemplate($name),$variable);
    }
}