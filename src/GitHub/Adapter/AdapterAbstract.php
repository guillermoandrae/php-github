<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

use Doctrine\Common\Cache\Cache;

abstract class AdapterAbstract implements AdapterInterface
{
    private $cache;

    private $httpClient;

    /**
     * {@inheritdoc}
     */
    public function get($uri, $params = [], $headers = [])
    {
        return $this->request('GET', $uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function post($uri, $params = [], $headers = [])
    {
        return $this->request('POST', $uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function put($uri, $params = [], $headers = [])
    {
        return $this->request('PUT', $uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function patch($uri, $params = [], $headers = [])
    {
        return $this->request('PATCH', $uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($uri, $params = [], $headers = [])
    {
        return $this->request('DELETE', $uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function head($uri, $params = [], $headers = [])
    {
        return $this->request('HEAD', $uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function options($uri, $params = [], $headers = [])
    {
        return $this->request('OPTIONS', $uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * {@inheritdoc}
     */
    public function setHttpClient($client)
    {
        $this->httpClient = $client;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }
}
