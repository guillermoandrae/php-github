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
    /**
     * @var \GitHub\Resource\User\User
     */
    private $user;

    public function testGetBio()
    {
        $this->assertSame('There once was...', $this->getUser()->getBio());
    }

    public function testGetFollowersUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat/followers', $this->getUser()->getFollowersUrl());
    }

    public function testGetFollowingUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat/following{/other_user}', $this->getUser()->getFollowingUrl());
    }

    public function testGetGistsUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat/gists{/gist_id}', $this->getUser()->getGistsUrl());
    }

    public function tesGetStarredUrl()
    {
        $this->assertSame('There once was...', $this->getUser()->getStarredUrl());
    }

    public function testGetSubscriptionsUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat/subscriptions', $this->getUser()->getSubscriptionsUrl());
    }

    public function testGetOrganizationsUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat/orgs', $this->getUser()->getOrganizationsUrl());
    }

    public function testGetReposUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat/repos', $this->getUser()->getReposUrl());
    }

    public function testGetEventsUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat/events{/privacy}', $this->getUser()->getEventsUrl());
    }

    public function testGetReceivedEventsUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat/received_events', $this->getUser()->getReceivedEventsUrl());
    }

    public function testGetStarredUrl()
    {
        $this->assertSame('https://api.github.com/users/octocat/starred{/owner}{/repo}', $this->getUser()->getStarredUrl());
    }

    public function testGetUpdatedAt()
    {
        $expectedDateTimeString = '2008-01-14T04:33:35Z';
        $this->assertEquals($expectedDateTimeString, $this->getUser()->getUpdatedAt(true));
        $this->assertEquals(new \DateTime($expectedDateTimeString), $this->getUser()->getUpdatedAt());
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

    /**
     * @return \GitHub\Resource\User\User
     */
    private function getUser()
    {
        return $this->user;
    }
}