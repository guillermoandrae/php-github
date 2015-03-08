<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource\Repository;

use GitHubTest\TestCase\ResourceTestCase;

class RepositoryTest extends ResourceTestCase
{
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
}