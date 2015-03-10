<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Http;

/**
 * Interface for dealing with HTTP methods.
 *
 * @package GitHub\Http
 */
interface ClientInterface
{
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
     * Sets credentials to use to authenticate requests.
     *
     * @param string $username The username to use
     * @param string $password The password or token to use
     * @param string $authScheme The authentication scheme to use
     *
     * @return $this
     * @throws \GitHub\Http\Exception\MissingCredentialsException
     * @throws \GitHub\Http\Exception\InvalidAuthenticationSchemeException
     */
    public function setAuthentication($username, $password, $authScheme);

    /**
     * Sends a GET request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function get($uri, array $params = [], array $headers = []);

    /**
     * Sends a POST request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function post($uri, array $params = [], array $headers = []);

    /**
     * Sends a PUT request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function put($uri, array $params = [], array $headers = []);

    /**
     * Sends a PATCH request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function patch($uri, array $params = [], array $headers = []);

    /**
     * Sends a DELETE request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function delete($uri, array $params = [], array $headers = []);

    /**
     * Sends a HEAD request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function head($uri, array $params = [], array $headers = []);

    /**
     * Sends a OPTIONS request to the GitHub API with the provided options.
     *
     * @param string $uri The request URI
     * @param array $params OPTIONAL Additional request parameters
     * @param array $headers OPTIONAL Additional request headers
     *
     * @return mixed
     */
    public function options($uri, array $params = [], array $headers = []);

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
    public function request($type, $uri, array $params = [], array $headers = []);

    /**
     * Sets the proxy to use when making requests.
     *
     * @param string $proxy
     * @return $this
     */
    public function setProxy($proxy);

    /**
     * Sets the base URL to use on requests.
     *
     * @param string $url
     * @return $this
     */
    public function setBaseUrl($url);
}
