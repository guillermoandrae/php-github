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

class UserMapperTest extends TestCase
{
    public function testFind()
    {
        $this->setMockResponse(200, ['login' => 'guillermoandrae']);
        $user = $this->getUserMapper()->find('guillermoandrae');
        $this->assertInstanceOf('\GitHub\Resource\User\User', $user);
        $this->assertSame('guillermoandrae', $user->getLogin());
    }

    public function testFindAll()
    {
        $this->setMockResponse(200, [['login' => 'foo'], ['login'=>'bar']]);
        $users = $this->getUserMapper()->findAll();
        $this->assertInstanceOf('\GitHub\Resource\Collection', $users);
        $this->assertNotCount(0, $users);
    }

    private function getUserMapper()
    {
        return $this->getResourceMapper('user');
    }
}