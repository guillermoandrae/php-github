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
use GuzzleHttp\Client;

class GuzzleAdapterTest extends TestCase
{
    public function testSetGetAuthentication()
    {
        $auth = ['octocat', '1234567890', AdapterInterface::AUTH_OAUTH_TOKEN];
        $result = $this->getAdapter()->setAuthentication($auth[0], $auth[1], $auth[2]);
        $this->assertInstanceOf('\GitHub\Adapter\GuzzleAdapter', $result);
        $this->assertSame($auth, $this->getAdapter()->getAuthentication());
    }

    /**
     * @expectedException \GitHub\Adapter\Exception\MissingCredentialsException
     */
    public function testSetMissingCredentialsAuthentication()
    {
        $auth = ['octocat', null, AdapterInterface::AUTH_OAUTH_TOKEN];
        $this->getAdapter()->setAuthentication($auth[0], $auth[1], $auth[2]);
        $this->setMockResponses([[200]]);
        $this->getAdapter()->get('/zen');
    }

    /**
     * @expectedException \GitHub\Adapter\Exception\InvalidAuthenticationSchemeException
     */
    public function testSetInvalidSchemeAuthentication()
    {
        $auth = ['octocat', '1234567890', 'foo'];
        $this->getAdapter()->setAuthentication($auth[0], $auth[1], $auth[2]);
        $this->setMockResponses([[200]]);
        $this->getAdapter()->get('/zen');
    }

    public function testSetGetHttpClient()
    {
        $httpClient = new Client(['base_url' => 'https://localhost:8080']);
        $result = $this->getAdapter()->setHttpClient($httpClient);
        $this->assertInstanceOf('\GitHub\Adapter\GuzzleAdapter', $result);
        $this->assertSame($httpClient, $this->getAdapter()->getHttpClient());
    }

    public function testSetGetCache()
    {
        $cache = new FilesystemCache('/tmp/php-github-test');
        $result = $this->getAdapter()->setCache($cache);
        $this->assertInstanceOf('\GitHub\Adapter\GuzzleAdapter', $result);
        $this->assertSame($cache, $this->getAdapter()->getCache());
    }

    public function testGet()
    {
        $uri = '/users/repos';
        $expectedStatusCode = 200;
        $expectedResult = $this->getMockData('repositories')[0];
        $this->setMockResponses([[$expectedStatusCode, $expectedResult]]);
        $this->assertSame($expectedResult, $this->getAdapter()->get($uri));
        $this->assertValidMockRequest('GET', $uri, $expectedStatusCode);
    }

    public function testPost()
    {
        $uri = '/users/repos';
        $expectedStatusCode = 201;
        $newRepository = array_merge($this->getMockData('repositories')[0], [
            'id' => 1296270,
            'name' => 'Hello-NewWorld',
        ]);
        $expectedResult = $newRepository;
        $this->setMockResponses([[$expectedStatusCode, $expectedResult]]);
        $params = $newRepository;
        unset($params['id']);
        $this->assertSame($expectedResult, $this->getAdapter()->post($uri, $params));
        $this->assertValidMockRequest('POST', $uri, $expectedStatusCode);
    }

    public function testPut()
    {
        $uri = '/users/octocat/suspended';
        $expectedStatusCode = 204;
        $this->setMockResponses([[$expectedStatusCode]]);
        $this->assertEmpty($this->getAdapter()->put($uri));
        $this->assertValidMockRequest('PUT', $uri, $expectedStatusCode);
    }

    public function testPatch()
    {
        $uri = '/repos/octocat/Hello-World';
        $expectedStatusCode = 200;
        $updates = ['name' => 'Hello-NewWorld'];
        $newRepository = array_merge($this->getMockData('repositories')[0], $updates);
        $expectedResult = $newRepository;
        $this->setMockResponses([[$expectedStatusCode, $expectedResult]]);
        $this->assertSame($expectedResult, $this->getAdapter()->patch($uri, $updates));
        $this->assertValidMockRequest('PATCH', $uri, $expectedStatusCode);
    }

    public function testDelete()
    {
        $uri = '/repos/octocat/Hello-World';
        $expectedStatusCode = 204;
        $this->setMockResponses([[$expectedStatusCode]]);
        $this->assertEmpty($this->getAdapter()->delete($uri));
        $this->assertValidMockRequest('DELETE', $uri, $expectedStatusCode);
    }

    public function testHead()
    {
        $uri = '/users/repos';
        $expectedStatusCode = 200;
        $this->setMockResponses([[$expectedStatusCode]]);
        $this->assertEmpty($this->getAdapter()->head($uri));
        $this->assertValidMockRequest('HEAD', $uri, $expectedStatusCode);
    }

    public function testOptions()
    {
        $uri = '/users/repos';
        $expectedStatusCode = 204;
        $this->setMockResponses([[$expectedStatusCode]]);
        $this->assertEmpty($this->getAdapter()->options($uri));
        $this->assertValidMockRequest('OPTIONS', $uri, $expectedStatusCode);
    }

    public function testRequest()
    {
        $uri = '/users/repos';
        $expectedMethod = 'GET';
        $expectedStatusCode = 200;
        $expectedResult = $this->getMockData('repositories')[0];
        $this->setMockResponses([[$expectedStatusCode, $expectedResult]]);
        $this->assertSame($expectedResult, $this->getAdapter()->request($expectedMethod, $uri));
        $this->assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode);
    }

    public function testCachedRequest()
    {
        $this->markTestSkipped('Need to figure out caching.');
        $uri = '/users/repos';
        $expectedMethod = 'GET';
        $expectedStatusCode = 200;
        $expectedResult = $this->getMockData('repositories')[0];
        $cache = new FilesystemCache('/tmp/php-github-test');
        $this->getAdapter()->setCache($cache);
        $this->setMockResponses([[$expectedStatusCode, $expectedResult]]);
        $this->assertSame($expectedResult, $this->getAdapter()->request($expectedMethod, $uri));
        $this->assertSame($expectedResult, $this->getAdapter()->getCache()->fetch(serialize([$expectedMethod, $uri])));
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
