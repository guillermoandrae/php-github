<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

use Doctrine\Common\Cache\Cache;

/**
 * Interface for all GitHub API adapters.
 *
 * @package GitHub\Adapter
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
interface AdapterInterface
{
    /**
     * Authentication type used when authenticating with GitHub username and password.
     *
     * @const string
     */
    const AUTH_HTTP_PASSWORD = 'digest';

    /**
     * Authentication type used when authenticating with GitHub username and OAuth token.
     *
     * @const string
     */
    const AUTH_OAUTH_TOKEN = 'basic';

    /**
     * HTTP GET method.
     *
     * @const string
     */
    const HTTP_GET = 'GET';

    /**
     * HTTP POST method.
     *
     * @const string
     */
    const HTTP_POST = 'POST';

    /**
     * HTTP PUT method.
     *
     * @const string
     */
    const HTTP_PUT = 'PUT';

    /**
     * HTTP PATCH method.
     *
     * @const string
     */
    const HTTP_PATCH = 'PATCH';

    /**
     * HTTP DELETE method.
     *
     * @const string
     */
    const HTTP_DELETE = 'DELETE';

    /**
     * HTTP HEAD method.
     *
     * @const string
     */
    const HTTP_HEAD = 'HEAD';

    /**
     * HTTP OPTIONS method.
     *
     * @const string
     */
    const HTTP_OPTIONS = 'OPTIONS';

    /**
     * Sets credentials to use to authenticate requests.
     *
     * @param string $username The username to use
     * @param string $password The password or token to use
     * @param string $authScheme The authentication scheme to use
     *
     * @return \GitHub\Adapter\AdapterInterface
     * @throws \GitHub\Adapter\Exception\MissingCredentialsException
     * @throws \GitHub\Adapter\Exception\InvalidAuthenticationSchemeException
     */
    public function setAuthentication($username, $password, $authScheme);

    /**
     * Returns the registered authentication credentials.
     *
     * @return array
     */
    public function getAuthentication();

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
     * Sends a GET request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function get($uri, $params = [], $headers = []);

    /**
     * Sends a POST request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function post($uri, $params = [], $headers = []);

    /**
     * Sends a PUT request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function put($uri, $params = [], $headers = []);

    /**
     * Sends a PATCH request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function patch($uri, $params = [], $headers = []);

    /**
     * Sends a DELETE request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function delete($uri, $params = [], $headers = []);

    /**
     * Sends a HEAD request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function head($uri, $params = [], $headers = []);

    /**
     * Sends a OPTIONS request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function options($uri, $params = [], $headers = []);

    /**
     * Sends a request to the GitHub API with the provided options.
     *
     * @param string $type The request method
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function request($type, $uri, $params = [], $headers = []);

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
