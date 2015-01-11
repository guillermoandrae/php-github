<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Adapter;

use Doctrine\Common\Cache\FilesystemCache;
use GitHub\Adapter\AdapterInterface;
use GitHubTest\TestCase\TestCase;

class GuzzleAdapterTest extends TestCase
{
    public function testSetAuthentication()
    {
        $auth = ['octocat', '1234567890', AdapterInterface::AUTH_OAUTH_TOKEN];
        $this->getAdapter()->setAuthentication($auth[0], $auth[1], $auth[2]);
        $this->assertSame($auth, $this->getAdapter()->getHttpClient()->getDefaultOption('auth'));
    }

    /**
     * @expectedException \GitHub\Client\Exception\AuthException
     */
    public function testSetInvalidAuthentication()
    {
        $auth = ['octocat', null, AdapterInterface::AUTH_OAUTH_TOKEN];
        $this->getAdapter()->setAuthentication($auth[0], $auth[1], $auth[2]);
        $this->setMockResponse(200);
        $this->getAdapter()->get('/zen');
    }

    public function testGetHttpClient()
    {
        $httpClient = $this->getAdapter()->getHttpClient();
        $this->assertInstanceOf('\GuzzleHttp\Client', $httpClient);
    }

    public function testGetCache()
    {
        $this->assertNull($this->getAdapter()->getCache());
        $cache = new FilesystemCache('/tmp/php-github-test');
        $this->assertInstanceOf('\Doctrine\Common\Cache\FilesystemCache', $cache);
    }

    public function testGet()
    {
        $uri = '/users/repos';
        $expectedMethod = 'GET';
        $expectedStatusCode = 200;
        $expectedResult = json_encode($this->getMockData('repositories')[0]);
        $this->setMockResponse($expectedStatusCode, $expectedResult);
        $this->assertSame($expectedResult, $this->getAdapter()->get($uri));
        $this->assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode);
    }

    public function testPost()
    {
        $uri = '/users/repos';
        $expectedMethod = 'POST';
        $expectedStatusCode = 201;
        $newRepository = array_merge($this->getMockData('repositories')[0], [
            'id' => 1296270,
            'name' => 'Hello-NewWorld',
        ]);
        $expectedResult = json_encode($newRepository);
        $this->setMockResponse($expectedStatusCode, $expectedResult);
        $params = $newRepository;
        unset($params['id']);
        $this->assertSame($expectedResult, $this->getAdapter()->post($uri, $params));
        $this->assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode);
    }

    public function testPut()
    {
        $uri = '/users/octocat/suspended';
        $expectedMethod = 'PUT';
        $expectedStatusCode = 204;
        $this->setMockResponse($expectedStatusCode);
        $this->assertEmpty($this->getAdapter()->put($uri));
        $this->assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode);
    }

    public function testPatch()
    {
        $uri = '/repos/octocat/Hello-World';
        $expectedMethod = 'PATCH';
        $expectedStatusCode = 200;
        $updates = ['name' => 'Hello-NewWorld'];
        $newRepository = array_merge($this->getMockData('repositories')[0], $updates);
        $expectedResult = json_encode($newRepository);
        $this->setMockResponse($expectedStatusCode, $expectedResult);
        $this->assertSame($expectedResult, $this->getAdapter()->patch($uri, $updates));
        $this->assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode);
    }

    public function testDelete()
    {
        $uri = '/repos/octocat/Hello-World';
        $expectedMethod = 'DELETE';
        $expectedStatusCode = 204;
        $this->setMockResponse($expectedStatusCode);
        $this->assertEmpty($this->getAdapter()->delete($uri));
        $this->assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode);
    }

    public function testHead()
    {
        $uri = '/users/repos';
        $expectedMethod = 'HEAD';
        $expectedStatusCode = 200;
        $this->setMockResponse($expectedStatusCode);
        $this->assertEmpty($this->getAdapter()->head($uri));
        $this->assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode);
    }

    public function testOptions()
    {
        $uri = '/users/repos';
        $expectedMethod = 'OPTIONS';
        $expectedStatusCode = 204;
        $this->setMockResponse($expectedStatusCode);
        $this->assertEmpty($this->getAdapter()->options($uri));
        $this->assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode);
    }

    public function testRequest()
    {
        $uri = '/users/repos';
        $expectedMethod = 'GET';
        $expectedStatusCode = 200;
        $expectedResult = json_encode($this->getMockData('repositories')[0]);
        $this->setMockResponse($expectedStatusCode, $expectedResult);
        $this->assertSame($expectedResult, $this->getAdapter()->request($expectedMethod, $uri));
        $this->assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode);
    }

    protected function assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode)
    {
        $expectedUrl = 'https://api.github.com' . $uri;
        $this->assertSame($expectedMethod, $this->getMockHistory()->getLastRequest()->getMethod());
        $this->assertSame($expectedUrl, $this->getMockHistory()->getLastResponse()->getEffectiveUrl());
        $this->assertSame($expectedStatusCode, $this->getMockHistory()->getLastResponse()->getStatusCode());
    }
} 