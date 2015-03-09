<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Enterprise;

use GitHub\Resource\ResourceMapperFactory;
use GitHubTest\TestCase\ResourceTestCase;

class LicenseTest extends ResourceTestCase
{
    public function testGetSeats()
    {
        $this->assertSame(1400, $this->getResource()->getSeats());
    }

    public function testGetSeatsUsed()
    {
        $this->assertSame(1316, $this->getResource()->getSeatsUsed());
    }

    public function testGetSeatsAvailable()
    {
        $this->assertSame(84, $this->getResource()->getSeatsAvailable());
    }

    public function testGetKind()
    {
        $this->assertSame('standard', $this->getResource()->getKind());
    }

    public function testGetDaysUntilExpiration()
    {
        $this->assertSame(365, $this->getResource()->getDaysUntilExpiration());
    }

    public function testGetExpireAt()
    {
        $this->assertSame('2016/02/06 12:41:52 -0600', $this->getResource()->getExpireAt(true));
    }

    protected function setUp()
    {
        $mockData = $this->getMockData('license');
        $this->setMockResponses([[200, $mockData]]);
        $mapper = ResourceMapperFactory::factory('enterprise', $this->getAdapter());
        $this->resource = $mapper->findLicense();
    }
}
