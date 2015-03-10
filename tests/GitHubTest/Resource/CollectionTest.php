<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource;

use GitHub\Resource\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    private $collection;

    public function testSetGetOffset()
    {
        $this->getCollection()->offsetSet('x', 'test');
        $this->assertSame('test', $this->getCollection()->offsetGet('x'));
    }

    public function testUnsetExistsOffset()
    {
        $this->getCollection()->offsetSet('test', 'offset');
        $this->assertTrue($this->getCollection()->offsetExists('test'));
        $this->getCollection()->offsetUnset('test');
        $this->assertFalse($this->getCollection()->offsetExists('test'));
    }

    public function testIsEmpty()
    {
        $this->assertFalse($this->getCollection()->isEmpty());
    }

    public function testTraversing()
    {
        $this->getCollection()->rewind();
        $this->getCollection()->next();
        $this->assertSame('b', $this->getCollection()->current());
        $this->assertSame(1, $this->getCollection()->key());
        $this->assertFalse($this->getCollection()->valid());
    }

    public function testCount()
    {
        $this->assertCount(3, $this->getCollection());
        $this->assertSame(3, $this->getCollection()->count());
    }

    protected function setUp()
    {
        $this->collection = new Collection(['a', 'b', 'c']);
    }

    /**
     * @return mixed
     */
    private function getCollection()
    {
        return $this->collection;
    }
}