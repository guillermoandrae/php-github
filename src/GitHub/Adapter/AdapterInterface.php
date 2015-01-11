<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

use Doctrine\Common\Cache\Cache;

interface AdapterInterface
{
    const AUTH_HTTP_PASSWORD = 'digest';
    const AUTH_OAUTH_TOKEN = 'basic';

    public function setAuthentication($username, $password, $authType);

    /**
     * @param \Doctrine\Common\Cache\Cache $cache
     */
    public function setCache(Cache $cache);

    /**
     * @return \Doctrine\Common\Cache\Cache
     */
    public function getCache();
    public function get($uri, $params = [], $headers = []);
    public function post($uri, $params = [], $headers = []);
    public function put($uri, $params = [], $headers = []);
    public function patch($uri, $params = [], $headers = []);
    public function delete($uri, $params = [], $headers = []);
    public function head($uri, $params = [], $headers = []);
    public function options($uri, $params = [], $headers = []);
    public function request($type, $uri, $params = [], $headers = []);
    public function setHttpClient($client);
    public function getHttpClient();
}
