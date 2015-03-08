<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource\Organization;

use GitHubTest\TestCase\ResourceMapperTestCase;

class OrganizationMapperTest extends ResourceMapperTestCase
{
    public function testFind()
    {
        $this->setMockResponse(200);
        $org = $this->getMapper()->find('github');
        $this->assertInstanceOf('\GitHub\Resource\Organization\Organization', $org);
        $this->assertRequestUri('/orgs/github');
    }

    public function testFindAll()
    {
        $this->setMockResponse(200, $this->getMockData('organizations'));
        $collection = $this->getMapper()->findAll();
        $this->assertRequestUri('/users');
        $this->assertCollectionNotEmpty($collection);
    }
}