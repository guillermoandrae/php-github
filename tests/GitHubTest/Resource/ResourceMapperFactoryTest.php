<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource;

use GitHub\Resource\ResourceMapperFactory;
use GitHubTest\TestCase\TestCase;

class ResourceMapperFactoryTest extends TestCase
{
    public function testResourceNotFoundException()
    {
        $this->setExpectedException('\GitHub\Resource\Exception\ResourceNotFoundException');
        ResourceMapperFactory::factory('foo', $this->getAdapter());
    }

    /**
     * @dataProvider getResourceAliases
     * @param string $alias
     */
    public function testResourceAlias($alias)
    {
        $mapper = ResourceMapperFactory::factory($alias, $this->getAdapter());
        $this->assertInstanceOf('\GitHub\Resource\ResourceMapperInterface', $mapper);
    }

    public function getResourceAliases()
    {
        return [
            ['repos'],
            ['repo'],
            ['user'],
            ['orgs'],
            ['org']
        ];
    }
}
