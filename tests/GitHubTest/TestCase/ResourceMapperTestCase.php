<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\TestCase;

use GitHub\Resource\ResourceMapperFactory;

class ResourceMapperTestCase extends TestCase implements ResourceNameAwareInterface
{
    /**
     * @var \GitHub\Resource\ResourceMapperInterface
     */
    protected $mapper;

    public function getResourceName()
    {
        $className = get_class($this);
        preg_match('/(\w+)MapperTest/', $className, $matches);
        return $matches[1];
    }

    /**
     * @param string $uri
     */
    protected function assertRequestUri($uri)
    {
        $this->assertSame($this->getMockHistory()->getLastRequest()->getPath(), $uri);
    }

    /**
     * @param array $query
     */
    protected function assertRequestQuery(array $query)
    {
        $this->assertSame($this->getMockHistory()->getLastRequest()->getQuery(), $query);
    }

    /**
     * @param string $body
     */
    protected function assertRequestBody($body)
    {
        $this->assertSame($this->getMockHistory()->getLastRequest()->getBody(), $body);
    }

    /**
     * @param mixed $collection
     */
    protected function assertCollection($collection)
    {
        $this->assertInstanceOf('\GitHub\Resource\Collection', $collection);
    }

    /**
     * @param mixed $collection
     */
    protected function assertCollectionNotEmpty($collection)
    {
        $this->assertCollection($collection);
        $this->assertNotCount(0, $collection);
    }

    /**
     * @param mixed $collection
     */
    protected function assertCollectionEmpty($collection)
    {
        $this->assertCollection($collection);
        $this->assertCount(0, $collection);
    }

    protected function setUp()
    {
        $name = $this->getResourceName();
        $this->mapper = ResourceMapperFactory::factory($name, $this->getAdapter());
    }

    /**
     * @return \GitHub\Resource\ResourceMapperInterface
     */
    protected function getMapper()
    {
        return $this->mapper;
    }
}
