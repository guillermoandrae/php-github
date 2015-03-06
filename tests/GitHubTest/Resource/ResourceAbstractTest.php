<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource;

class ResourceAbstractTest extends \PHPUnit_Framework_TestCase
{
    private $resource;

    public function testCall()
    {
        $this->assertSame('foo', $this->getResource()->getName());
    }

    public function testNonExistentProperty()
    {
        $message = sprintf(
            'The %s property does not exist on the \'%s\' object.',
            'foo',
            get_class($this->getResource())
        );
        $this->setExpectedException('\BadMethodCallException', $message);
        $this->getResource()->getFoo();
    }

    public function testNonExistentMethod()
    {
        $message = sprintf(
            'The %s method does not exist on the \'%s\' object.',
            'isReal',
            get_class($this->getResource())
        );
        $this->setExpectedException('\BadMethodCallException', $message);
        $this->getResource()->isReal();
    }

    protected function setUp()
    {
        $this->resource = $this->getMockForAbstractClass(
            '\GitHub\Resource\ResourceAbstract',
            [
                ['name' => 'foo']
            ]
        );
    }

    private function getResource()
    {
        return $this->resource;
    }
}
