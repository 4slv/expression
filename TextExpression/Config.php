<?php


namespace Slov\Expression\TextExpression;


class Config
{
    /**
     * @var bool
     */
    protected $cache = true;

    /**
     * @var bool
     */
    protected $expressionInSingleFile = true;

    /**
     * @var string
     */
    protected $cacheFolder = __DIR__.DIRECTORY_SEPARATOR.'../tmp';

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
     * @return bool|null
     */
    public function isCache(): bool
    {
        return $this->cache;
    }

    /**
     * @param bool $cache
     * @return $this
     */
    public function setCache(bool $cache)
    {
        $this->cache = $cache;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCacheFolder(): string
    {
        return $this->cacheFolder;
    }

    /**
     * @param string $cacheFolder
     * @return $this
     */
    public function setCacheFolder(string $cacheFolder)
    {
        $this->cacheFolder = $cacheFolder;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isExpressionInSingleFile(): ?bool
    {
        return $this->expressionInSingleFile;
    }

    /**
     * @param bool $expressionInSingleFile
     * @return $this
     */
    public function setExpressionInSingleFile(?bool $expressionInSingleFile)
    {
        $this->expressionInSingleFile = $expressionInSingleFile;
        return $this;
    }


}