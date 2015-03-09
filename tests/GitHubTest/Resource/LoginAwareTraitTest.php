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

    public function testGetNumPrivateRepos()
    {
        $this->assertSame(100, $this->getUser()->getNumPrivateRepos());
    }

    public function testGetNumOwnedPrivateRepos()
    {
        $this->assertSame(100, $this->getUser()->getNumOwnedPrivateRepos());
    }

    public function testGetNumPublicRepos()
    {
        $this->assertSame(2, $this->getUser()->getNumPublicRepos());
    }

    public function testGetNumPublicGists()
    {
        $this->assertSame(1, $this->getUser()->getNumPublicGists());
    }

    public function testGetNumPPrivateGists()
    {
        $this->assertSame(81, $this->getUser()->getNumPrivateGists());
    }

    public function testGetCompany()
    {
        $this->assertSame('GitHub', $this->getUser()->getCompany());
    }

    public function testGetDiskUsage()
    {
        $this->assertSame(10000, $this->getUser()->getDiskUsage());
    }

    public function testGetNumCollaborators()
    {
        $this->assertSame(8, $this->getUser()->getNumCollaborators());
    }

    public function testGetBlog()
    {
        $this->assertSame('https://github.com/blog', $this->getUser()->getBlog());
    }

    public function testGetLocation()
    {
        $this->assertSame('San Francisco', $this->getUser()->getLocation());
    }

    public function testGetId()
    {
        $this->assertSame(1, $this->getUser()->getId());
    }

    public function testGetNumFollowers()
    {
        $this->assertSame(20, $this->getUser()->getNumFollowers());
    }

    public function testGetNumFollowing()
    {
        $this->assertSame(0, $this->getUser()->getNumFollowing());
    }

    public function testGetHtmlUrl()
    {
        $this->assertSame('https://github.com/octocat', $this->getUser()->getHtmlUrl());
    }

    public function testGetPlan()
    {
        $plan = $this->getUser()->getPlan();
        $this->assertSame('Medium', $plan['name']);
    }

    protected function setUp()
    {
        $this->setMockResponses([[200, $this->getMockData('users')[0]]]);
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
