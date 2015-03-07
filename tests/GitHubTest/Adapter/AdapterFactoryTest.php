<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Adapter;

use GitHub\Adapter\AdapterFactory;

class AdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testAdapterNotFound()
    {
        $this->setExpectedException('\GitHub\Adapter\Exception\AdapterNotFoundException');
        AdapterFactory::factory('foo');
    }
}
