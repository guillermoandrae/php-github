<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Client;

use Doctrine\Common\Cache\FilesystemCache;
use GitHub\Adapter\AdapterAwareTrait;
use GitHub\Adapter\AdapterInterface;
use GitHub\Adapter\GuzzleAdapter;
use GitHub\Resource\ResourceMapperFactory;

/**
 * GitHub Client.
 *
 * @package GitHub\Client
 */
class Client implements ClientInterface
{
    use AdapterAwareTrait;

    /**
     * Builds the client.
     *
     * Takes an adapter as its only argument. If none is provided, defaults to
     * the GuzzleAdapter.
     *
     * @param AdapterInterface $adapter OPTIONAL An adapter object
     */
    public function __construct(AdapterInterface $adapter = null)
    {
        if (!$adapter) {
            $adapter = new GuzzleAdapter();
            $path = defined('GITHUB_CACHE_PATH') ? GITHUB_CACHE_PATH : sys_get_temp_dir() . '/github';
            $adapter->setCache(new FilesystemCache($path));
        }
        $this->setAdapter($adapter);
    }

    /**
     * {@inheritdoc}
     */
    public function getResource($name)
    {
        return ResourceMapperFactory::factory($name, $this->getAdapter());
    }
}
