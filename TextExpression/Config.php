<?php


namespace Slov\Expression\TextExpression;


class Config
{
    protected $cache = true;

    /**
     * @var string
     */
    protected $cacheFolder = __DIR__.DIRECTORY_SEPARATOR.'../tmp';


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



}