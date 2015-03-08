<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource\Repository;

use GitHub\Resource\ResourceMapperFactory;
use GitHubTest\TestCase\ResourceTestCase;

class RepositoryTest extends ResourceTestCase
{
    public function testGetOwner()
    {
        $owner = $this->getResource()->getOwner();
        $this->assertInstanceOf('\GitHub\Resource\User\User', $owner);
        $this->assertSame('octocat', $owner->getLogin());
    }

    public function testGetId()
    {
        $this->assertSame(1296269, $this->getResource()->getId());
    }

    public function testGetName()
    {
        $this->assertSame('Hello-World', $this->getResource()->getName());
    }

    public function testGetFullName()
    {
        $this->assertSame('octocat/Hello-World', $this->getResource()->getFullName());
    }

    public function testGetDescription()
    {
        $this->assertSame('This your first repo!', $this->getResource()->getDescription());
    }

    public function testIsPrivate()
    {
        $this->assertFalse($this->getResource()->isPrivate());
    }

    public function testIsFork()
    {
        $this->assertTrue($this->getResource()->isFork());
    }

    public function testGetUrl()
    {
        $this->assertSame('https://api.github.com/repos/octocat/Hello-World', $this->getResource()->getUrl());
    }

    public function testGetHtmlUrl()
    {
        $this->assertSame('https://github.com/octocat/Hello-World', $this->getResource()->getHtmlUrl());
    }

    public function testGetCloneUrl()
    {
        $this->assertSame('https://github.com/octocat/Hello-World.git', $this->getResource()->getCloneUrl());
    }

    public function testGetGitUrl()
    {
        $this->assertSame('git://github.com/octocat/Hello-World.git', $this->getResource()->getGitUrl());
    }

    public function testGetSshUrl()
    {
        $this->assertSame('git@github.com:octocat/Hello-World.git', $this->getResource()->getSshUrl());
    }

    public function testGetSvnUrl()
    {
        $this->assertSame('https://svn.github.com/octocat/Hello-World', $this->getResource()->getSvnUrl());
    }

    public function testGetMirrorUrl()
    {
        $this->assertSame('git://git.example.com/octocat/Hello-World', $this->getResource()->getMirrorUrl());
    }

    public function testGetHomepage()
    {
        $this->assertSame('https://github.com', $this->getResource()->getHomepage());
    }

    public function testGetLanguage()
    {
        $this->assertNull($this->getResource()->getLanguage());
    }

    public function testGetForksCount()
    {
        $this->assertSame(9, $this->getResource()->getForksCount());
    }

    public function testGetStargazersCount()
    {
        $this->assertSame(80, $this->getResource()->getStargazersCount());
    }

    public function testGetWatchersCount()
    {
        $this->assertSame(80, $this->getResource()->getWatchersCount());
    }

    public function testGetSize()
    {
        $this->assertSame(108, $this->getResource()->getSize());
    }

    public function testGetDefaultBranch()
    {
        $this->assertSame('master', $this->getResource()->getDefaultBranch());
    }

    public function testGetOpenIssuesCount()
    {
        $this->assertSame(0, $this->getResource()->getOpenIssuesCount());
    }

    public function testHasIssues()
    {
        $this->assertTrue($this->getResource()->hasIssues());
    }

    public function testHasWiki()
    {
        $this->assertTrue($this->getResource()->hasWiki());
    }

    public function testHasPages()
    {
        $this->assertFalse($this->getResource()->hasPages());
    }

    public function testHasDownloads()
    {
        $this->assertTrue($this->getResource()->hasDownloads());
    }

    public function testGetPushedAt()
    {
        $this->assertSame('2011-01-26T19:06:43Z', $this->getResource()->getPushedAt(true));
    }

    public function testGetCreatedAt()
    {
        $this->assertSame('2011-01-26T19:01:12Z', $this->getResource()->getCreatedAt(true));
    }

    public function testGetUpdatedAt()
    {
        $this->assertSame('2011-01-26T19:14:43Z', $this->getResource()->getUpdatedAt(true));
    }

    public function testGetPermissions()
    {
        $expectedPermissions = ['admin' => false, 'push' => false, 'pull' => true];
        $this->assertSame($expectedPermissions, $this->getResource()->getPermissions());
    }

    protected function setUp()
    {
        $name = $this->getResourceName();
        $this->setMockResponses([
            ['statusCode' => 200, 'body' => $this->getMockData('repositories')],
            ['statusCode' => 200, 'body' => $this->getMockData('users')[0]],
        ]);
        $mapper = ResourceMapperFactory::factory($name, $this->getAdapter());
        $collection = $mapper->findAll();
        $this->resource = $collection->current();
    }
}
