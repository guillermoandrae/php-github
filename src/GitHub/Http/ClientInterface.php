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
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
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
     * @param string $authScheme The authentication scheme to use
     * @param string $username The username or OAuth token
     * @param string $password OPTIONAL The password
     *
     * @return $this
     * @throws \GitHub\Http\Exception\MissingCredentialsException
     * @throws \GitHub\Http\Exception\InvalidAuthenticationSchemeException
     */
    public function authenticate($authScheme, $username, $password = null);

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
     * @param string $proxy  The proxy
     * @return $this
     */
    public function setProxy($proxy);

    /**
     * Sets the base URL to use on requests (GitHub Enterprise).
     *
     * @param string $url  The base URL
     * @return $this
     */
    public function setBaseUrl($url);
}
