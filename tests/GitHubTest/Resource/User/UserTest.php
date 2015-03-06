<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource\User;

use GitHub\Resource\User\UserMapper;
use GitHubTest\TestCase\TestCase;

class UserTest extends TestCase
{
    public function testMe()
    {
        $this->assertTrue(true);
    }

    protected function setUp()
    {
        $this->setMockResponse(200, $this->getMockData('user')[0]);
        $mapper = new UserMapper();
        $mapper->setAdapter($this->getAdapter());
        $this->user = $mapper->find('guillermoandrae');
    }
}