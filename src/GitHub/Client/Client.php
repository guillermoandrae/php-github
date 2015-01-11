<?php

namespace GitHub\Client;

use Doctrine\Common\Cache\FilesystemCache;
use GitHub\Adapter\AdapterAwareTrait;
use GitHub\Adapter\AdapterInterface;
use GitHub\Adapter\GuzzleAdapter;
use GitHub\Resource\ResourceMapperFactory;

class Client implements ClientInterface
{
    use AdapterAwareTrait;

    public function __construct(AdapterInterface $adapter = null)
    {
        if (!$adapter) {
            $adapter = new GuzzleAdapter();
            $path = defined('GITHUB_CACHE_PATH') ? GITHUB_CACHE_PATH : sys_get_temp_dir() . '/github';
            $adapter->setCache(new FilesystemCache($path));
        }
        $this->setAdapter($adapter);
    }

    public function getResource($name)
    {
        return ResourceMapperFactory::factory($name, $this->getAdapter());
    }
}
