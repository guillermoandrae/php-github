<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Client;

use GitHub\Client\Client;
use GitHubTest\TestCase\TestCase;
use GitHub\Http\ClientInterface as HttpClientInterface;

class ClientTest extends TestCase
{
    /**
     * @var \GitHub\Client\Client
     */
    private $client;

    /**
     * @runInSeparateProcess
     * @backupGlobals disabled
     */
    public function testUrlConstant()
    {
        $url = 'https://github.constant';
        define('GITHUB_URL', $url);
        $client = new Client();
        $this->assertSame($url, $client->getAdapter()->getHttpClient()->getBaseUrl());
    }

    /**
     * @runInSeparateProcess
     * @backupGlobals disabled
     */
    public function testOauthTokenConstant()
    {
        $token = '1234567890';
        define('GITHUB_OAUTH_TOKEN', $token);
        $client = new Client();
        $auth = $client->getAdapter()->getHttpClient()->getDefaultOption('auth');
        $this->assertSame($token, $auth[0]);
        $this->assertSame(HttpClientInterface::AUTH_OAUTH_TOKEN, $auth[2]);
    }

    /**
     * @runInSeparateProcess
     * @backupGlobals disabled
     */
    public function testUsernamePasswordConstants()
    {
        $username = 'foo';
        $password = 'bar';
        define('GITHUB_USERNAME', $username);
        define('GITHUB_PASSWORD', $password);
        $client = new Client();
        $auth = $client->getAdapter()->getHttpClient()->getDefaultOption('auth');
        $this->assertSame($username, $auth[0]);
        $this->assertSame($password, $auth[1]);
        $this->assertSame(HttpClientInterface::AUTH_HTTP_PASSWORD, $auth[2]);
    }

    public function testResource()
    {
        $client = $this->getClient();
        $resource = $client->resource('zen');
        $this->assertInstanceOf('\GitHub\Resource\ResourceMapperInterface', $resource);
    }

    /**
     * @expectedException \GitHub\Resource\Exception\ResourceNotFoundException
     */
    public function testResourceNotFound()
    {
        $client = $this->getClient();
        $client->resource('foo');
    }

    /**
     * @dataProvider getProxyHttpMethods
     * @param $method
     */
    public function testProxyHttpMethod($method)
    {
        $expectedValue = 'Success!';
        $adapter = $this->getMockAdapter($method, $expectedValue);
        $client = (new Client())->setAdapter($adapter);
        $result = call_user_func([$client, $method], '/test');
        $this->assertSame($expectedValue, $result);
    }

    public function getProxyHttpMethods()
    {
        return [
            ['get'],
            ['post'],
            ['put'],
            ['patch'],
            ['options'],
            ['head'],
            ['delete']
        ];
    }

    public function testRequest()
    {
        $expectedValue = 'Success!';
        $adapter = $this->getMockAdapter('request', $expectedValue);
        $client = (new Client())->setAdapter($adapter);
        $result = $client->request('GET', '/test');
        $this->assertSame($expectedValue, $result);
    }

    public function testSetAuthentication()
    {
        $adapter = $this->getMockAdapter('setAuthentication');
        $client = (new Client())->setAdapter($adapter);
        $result = $client->setAuthentication('username', 'password', HttpClientInterface::AUTH_HTTP_PASSWORD);
        $this->assertInstanceOf('\GitHub\Client\ClientInterface', $result);
    }

    public function testSetBaseUrl()
    {
        $adapter = $this->getMockAdapter('setBaseUrl');
        $client = (new Client())->setAdapter($adapter);
        $result = $client->setBaseUrl('http://foo');
        $this->assertInstanceOf('\GitHub\Client\ClientInterface', $result);
    }

    public function testSetProxy()
    {
        $adapter = $this->getMockAdapter('setProxy');
        $client = (new Client())->setAdapter($adapter);
        $result = $client->setProxy('tcp://some.proxy');
        $this->assertInstanceOf('\GitHub\Client\ClientInterface', $result);
    }

    protected function setUp()
    {
        $this->client = new Client();
        $this->client->setAdapter($this->getAdapter());
    }

    private function getClient()
    {
        return $this->client;
    }

    private function getMockAdapter($method, $output = null)
    {
        $adapter = $this->getMockForAbstractClass('\GitHub\Adapter\AdapterAbstract');
        if (null === $output) {
            $adapter->expects($this->once())
                ->method($method);
        } else {
            $adapter->expects($this->once())
                ->method($method)
                ->will($this->returnValue($output));
        }
        return $adapter;
    }
}
