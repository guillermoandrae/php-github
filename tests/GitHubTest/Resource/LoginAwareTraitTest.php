<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource;

use GitHub\Resource\User\UserMapper;
use GitHubTest\TestCase\TestCase;

class LoginAwareTraitTest extends TestCase
{
    private $user;

    public function testLogin()
    {
        $this->assertSame('octocat', $this->getUser()->getLogin());
    }

    public function testName()
    {
        $this->assertSame('monalisa octocat', $this->getUser()->getName());
    }

    public function testType()
    {
        $this->assertSame('User', $this->getUser()->getType());
    }

    public function testEmail()
    {
        $this->assertSame('octocat@github.com', $this->getUser()->getEmail());
    }

    public function testUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat', $this->getUser()->getUrl());
    }

    public function testGetAvatarUrl()
    {
        $this->assertSame('https://github.com/images/error/octocat_happy.gif', $this->getUser()->getAvatarUrl());
    }

    public function testCreatedAt()
    {
        $expectedDateTimeString = '2008-01-14T04:33:35Z';
        $this->assertSame($expectedDateTimeString, $this->getUser()->getCreatedAt(true));
        $expectedDateTimeObject = new \DateTime($expectedDateTimeString);
        $actualDateTimeObject = $this->getUser()->getCreatedAt();
        $this->assertEquals($expectedDateTimeObject, $actualDateTimeObject);
    }

    protected function setUp()
    {
        $this->setMockResponse(200, $this->getMockData('user')[0]);
        $mapper = new UserMapper();
        $mapper->setAdapter($this->getAdapter());
        $this->user = $mapper->find('octocat');
    }

    /**
     * @return \GitHub\Resource\User\User
     */
    private function getUser()
    {
        return $this->user;
    }
}
