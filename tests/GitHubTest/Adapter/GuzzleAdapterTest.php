<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Adapter;

use Doctrine\Common\Cache\FilesystemCache;
use GitHub\Http\ClientInterface as HttpClientInterface;
use GitHubTest\TestCase\TestCase;
use GuzzleHttp\Client;

class GuzzleAdapterTest extends TestCase
{
    public function testAuthenticate()
    {
        $auth = ['octocat', '1234567890', HttpClientInterface::AUTH_OAUTH_TOKEN];
        $result = $this->getAdapter()->authenticate($auth[2], $auth[0], $auth[1]);
        $this->assertInstanceOf('\GitHub\Adapter\GuzzleAdapter', $result);
        $this->assertSame($auth, $this->getAdapter()->getHttpClient()->getDefaultOption('auth'));
    }

    public function testMissingCredentialsUsername()
    {
        $this->setExpectedException('\GitHub\Http\Exception\MissingCredentialsException');
        $this->getAdapter()->authenticate(HttpClientInterface::AUTH_HTTP_PASSWORD, null, 'password');
    }

    public function testMissingCredentialsPassword()
    {
        $this->setExpectedException('\GitHub\Http\Exception\MissingCredentialsException');
        $this->getAdapter()->authenticate(HttpClientInterface::AUTH_HTTP_PASSWORD, 'octocat', null);
    }

    public function testInvalidAuthenticationScheme()
    {
        $this->setExpectedException('\GitHub\Http\Exception\InvalidAuthenticationSchemeException');
        $this->getAdapter()->authenticate('foo', 'octocat', 'password');
    }

    public function testInvalidAuthCredentials()
    {
        $this->setMockResponses([
            [
                401,
                [
                    'message' => 'Bad credentials',
                    'documentation_url' => 'https://developer.github.com/v3'
                ]
            ]
        ]);
        $this->setExpectedException('\GitHub\Http\Exception\InvalidAuthCredentialsException');
        $this->getAdapter()->get('/zen');
    }

    public function testMaximumAuthAttempts()
    {
        $this->setMockResponses([
            [
                403,
                [
                    'message' => 'Maximum number of login attempts exceeded. Please try again later.',
                    'documentation_url' => 'https://developer.github.com/v3'
                ]
            ]
        ]);
        $this->setExpectedException('\GitHub\Http\Exception\MaximumAuthAttemptsException');
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
        $uri = '/users/repos';
        $expectedMethod = 'GET';
        $expectedResult = $this->getMockData('repositories')[0];
        $cache = new FilesystemCache('./build/cache');
        $this->getAdapter()->setCache($cache);
        $this->setMockResponses([[200, $expectedResult]]);
        for ($i=0; $i<3; $i++) {
            $this->assertSame($expectedResult, $this->getAdapter()->request($expectedMethod, $uri));
        }
        $this->assertNotNull($this->getAdapter()->getCache()->getStats()['memory_usage']);
    }

    public function testSetBaseUrl()
    {
        $baseUrl = 'https://github.local';
        $result = $this->getAdapter()->setBaseUrl($baseUrl);
        $this->assertSame($baseUrl, $this->getAdapter()->getHttpClient()->getBaseUrl());
        $this->assertInstanceOf('\GitHub\Adapter\GuzzleAdapter', $result);

    }

    public function testSetProxy()
    {
        $proxy = 'tcp://some.proxy';
        $result = $this->getAdapter()->setProxy($proxy);
        $this->assertSame($proxy, $this->getAdapter()->getHttpClient()->getDefaultOption('proxy'));
        $this->assertInstanceOf('\GitHub\Adapter\GuzzleAdapter', $result);

    }

    protected function assertValidMockRequest($expectedMethod, $uri, $expectedStatusCode)
    {
        $expectedUrl = 'https://api.github.com' . $uri;
        $this->assertSame($expectedMethod, $this->getMockHistory()->getLastRequest()->getMethod());
        $this->assertSame($expectedUrl, $this->getMockHistory()->getLastResponse()->getEffectiveUrl());
        $this->assertSame($expectedStatusCode, $this->getMockHistory()->getLastResponse()->getStatusCode());
    }
}
