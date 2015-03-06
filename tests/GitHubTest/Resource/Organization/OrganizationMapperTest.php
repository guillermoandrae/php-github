<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource\Organization;

use GitHubTest\TestCase\TestCase;

class OrganizationMapperTest extends TestCase
{
    public function testFind()
    {
        $this->setMockResponse(200, $this->getMockData('organizations')[0]);
        $org = $this->getOrganizationMapper()->find('github');
        $this->assertInstanceOf('\GitHub\Resource\Organization\Organization', $org);
        $this->assertSame('github', $org->getLogin());
    }

    public function testFindAll()
    {
        $this->setMockResponse(200, $this->getMockData('organizations'));
        $orgs = $this->getOrganizationMapper()->findAll();
        $this->assertInstanceOf('\GitHub\Resource\Collection', $orgs);
        $this->assertNotCount(0, $orgs);
    }

    private function getOrganizationMapper()
    {
        return $this->getResourceMapper('organization');
    }
}