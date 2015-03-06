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
    private $user;

    public function testGetBio()
    {
        $this->assertSame('There once was...', $this->getUser()->getBio());
    }

    public function testIsHireable()
    {
        $this->assertFalse($this->getUser()->isHireable());
    }

    public function testIsSiteAdmin()
    {
        $this->assertFalse($this->getUser()->isSiteAdmin());
    }

    protected function setUp()
    {
        $this->setMockResponse(200, $this->getMockData('users')[0]);
        $mapper = new UserMapper();
        $mapper->setAdapter($this->getAdapter());
        $this->user = $mapper->find('octocat');
    }

    private function getUser()
    {
        return $this->user;
    }
}