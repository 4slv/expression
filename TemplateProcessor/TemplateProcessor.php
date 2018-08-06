<?php

namespace Slov\Expression\TemplateProcessor;

use Slov\Expression\TextExpression\Config;

class TemplateProcessor
{


    const templates = 'templates';
    const extension = '.txt';

    protected static $self;


    protected function __construct(){}

    /**
     * @return $this
     */
    public static function getInstance()
    {
        if(is_null(static::$self))
            static::$self = new static();
        return static::$self;
    }

    /**
     * @var Config
     */
    protected $config;


    /**
     * @param string[] $relativePath
     * @return string
     */
    public function getTemplateDir($relativePath = [])
    {
        $path = [ __DIR__,static::templates];
        !empty($relativePath) && $path[] = implode(DIRECTORY_SEPARATOR,$relativePath);
        return implode(DIRECTORY_SEPARATOR, $path);
    }

    /**
     * @param string $name
     * @param string[] $relativePath
     * @return bool|string
     */
    public function getTemplateByName(string $name, $relativePath = [])
    {
        return file_get_contents($this->getTemplateDir($relativePath).DIRECTORY_SEPARATOR.$name.static::extension);
    }







}