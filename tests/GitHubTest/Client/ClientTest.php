<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Client;

use GitHub\Client\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \GitHub\Client\Client
     */
    private $client;

    public function testGetResource()
    {
        $client = $this->getClient();
        $resource = $client->getResource('zen');
        $this->assertInstanceOf('\GitHub\Resource\ResourceMapperInterface', $resource);
    }

    /**
     * @expectedException \GitHub\Resource\Exception\InvalidResourceException
     */
    public function testGetInvalidResource()
    {
        $client = $this->getClient();
        $client->getResource('foo');
    }

    protected function setUp()
    {
        $this->client = new Client();
    }

    protected function getClient()
    {
        return $this->client;
    }
}
