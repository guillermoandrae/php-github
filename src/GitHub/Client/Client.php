<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Client;

use GitHub\Adapter\AdapterAwareTrait;
use GitHub\Http\ClientInterface as HttpClientInterface;
use GitHub\Adapter\AdapterFactory;
use GitHub\Adapter\AdapterInterface;
use GitHub\Resource\ResourceMapperFactory;

/**
 * GitHub Client.
 *
 * @package GitHub\Client
 */
class Client implements ClientInterface, HttpClientInterface
{
    use AdapterAwareTrait;

    /**
     * @param AdapterInterface $adapter
     * @throws \GitHub\Adapter\Exception\AdapterNotFoundException
     */
    public function __construct(AdapterInterface $adapter = null)
    {
        if (!$adapter) {
            $this->setAdapter(AdapterFactory::factory('guzzle'));
        }
        if (defined('GITHUB_URL')) {
            $this->setBaseUrl(GITHUB_URL);
        }
        if (defined('GITHUB_OAUTH_TOKEN')) {
            $this->setAuthentication(GITHUB_OAUTH_TOKEN, null, AdapterInterface::AUTH_OAUTH_TOKEN);
        } elseif (defined('GITHUB_USERNAME') && defined('GITHUB_PASSWORD')) {
            $this->setAuthentication(GITHUB_USERNAME, GITHUB_PASSWORD, AdapterInterface::AUTH_HTTP_PASSWORD);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function resource($name)
    {
        return ResourceMapperFactory::factory($name, $this->getAdapter());
    }

    /**
     * {@inheritdoc}
     */
    public function get($uri, array $params = [], array $headers = [])
    {
        return $this->getAdapter()->get($uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function post($uri, array $params = [], array $headers = [])
    {
        return $this->getAdapter()->post($uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function put($uri, array $params = [], array $headers = [])
    {
        return $this->getAdapter()->put($uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function patch($uri, array $params = [], array $headers = [])
    {
        return $this->getAdapter()->patch($uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($uri, array $params = [], array $headers = [])
    {
        return $this->getAdapter()->delete($uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function head($uri, array $params = [], array $headers = [])
    {
        return $this->getAdapter()->head($uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function options($uri, array $params = [], array $headers = [])
    {
        return $this->getAdapter()->options($uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function request($type, $uri, array $params = [], array $headers = [])
    {
        return $this->getAdapter()->request($type, $uri, $params, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthentication($username, $password, $authScheme)
    {
        $this->getAdapter()->setAuthentication($username, $password, $authScheme);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setBaseUrl($url)
    {
        $this->getAdapter()->setBaseUrl($url);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setProxy($proxy)
    {
        $this->getAdapter()->setProxy($proxy);
        return $this;
    }
}
