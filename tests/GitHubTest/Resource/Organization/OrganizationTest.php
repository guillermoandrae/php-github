<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource\Organization;

use GitHub\Resource\Organization\OrganizationMapper;
use GitHubTest\TestCase\TestCase;

class OrganizationTest extends TestCase
{
    public function testGetDescription()
    {
        $this->assertSame('A great organization', $this->getOrg()->getDescription());
    }

    public function testGetBillingEmail()
    {
        $this->assertSame('support@github.com', $this->getOrg()->getBillingEmail());
    }

    protected function setUp()
    {
        $this->setMockResponse(200, $this->getMockData('organizations')[0]);
        $mapper = new OrganizationMapper();
        $mapper->setAdapter($this->getAdapter());
        $this->org = $mapper->find('github');
    }

    private function getOrg()
    {
        return $this->org;
    }
}