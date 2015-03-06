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

class ClientTest extends TestCase
{
    /**
     * @var \GitHub\Client\Client
     */
    private $client;

    public function testGetResource()
    {
        $client = $this->getClient();
        $resource = $client->resource('zen');
        $this->assertInstanceOf('\GitHub\Resource\ResourceMapperInterface', $resource);
    }

    /**
     * @expectedException \GitHub\Resource\Exception\ResourceNotFoundException
     */
    public function testGetNotFoundResource()
    {
        $client = $this->getClient();
        $client->resource('foo');
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
}
