<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

use Doctrine\Common\Cache\Cache;
use GitHub\Http\ClientInterface;

/**
 * Interface for all GitHub API adapters.
 *
 * @package GitHub\Adapter
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
interface AdapterInterface extends ClientInterface
{
    /**
     * Registers a cache object.
     *
     * @param \Doctrine\Common\Cache\Cache $cache The cache object
     *
     * @return \GitHub\Adapter\AdapterInterface
     */
    public function setCache(Cache $cache);

    /**
     * Returns the registered cache object.
     *
     * @return \Doctrine\Common\Cache\Cache
     */
    public function getCache();

    /**
     * Registers an HTTP client object.
     *
     * @param mixed $client The HTTP client object
     *
     * @return \GitHub\Adapter\AdapterInterface
     */
    public function setHttpClient($client);

    /**
     * Returns the registered HTTP client object.
     *
     * @return mixed
     */
    public function getHttpClient();
}
