<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource\Repository;

use GitHubTest\TestCase\ResourceMapperTestCase;

class RepositoryMapperTest extends ResourceMapperTestCase
{
    public function testFindAll()
    {
        $this->setMockResponses([[200]]);
        $this->getMapper()->findAll();
        $this->assertRequestUri('/repositories');
    }

    public function testFindMine()
    {
        $this->setMockResponses([[200]]);
        $this->getMapper()->findMine();
        $this->assertRequestUri('/user/repos');
    }

    public function testFindByUser()
    {
        $this->setMockResponses([[200]]);
        $this->getMapper()->findByUser('octocat');
        $this->assertRequestUri('/users/octocat/repos');
    }

    public function testFindByOrganization()
    {
        $this->setMockResponses([[200]]);
        $this->getMapper()->findByOrganization('github');
        $this->assertRequestUri('/orgs/github/repos');
    }
}
