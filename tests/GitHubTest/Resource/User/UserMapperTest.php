<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource\User;

use GitHubTest\TestCase\ResourceMapperTestCase;

class UserMapperTest extends ResourceMapperTestCase
{
    public function testFind()
    {
        $this->setMockResponses([[200]]);
        $this->getMapper()->find('octocat');
        $this->assertRequestUri('/users/octocat');
    }

    public function testFindMe()
    {
        $this->setMockResponses([[200]]);
        $this->getMapper()->findMe();
        $this->assertRequestUri('/user');
    }

    public function testFindAll()
    {
        $this->setMockResponses([[200, $this->getMockData('users')]]);
        $users = $this->getMapper()->findAll();
        $this->assertRequestUri('/users');
        $this->assertCollectionNotEmpty($users);
    }
}
