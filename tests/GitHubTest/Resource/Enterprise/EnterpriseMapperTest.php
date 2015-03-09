<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Enterprise;

use GitHubTest\TestCase\ResourceMapperTestCase;

class EnterpriseMapperTest extends ResourceMapperTestCase
{
    public function testFindLicense()
    {
        $this->setMockResponses([[200]]);
        $license = $this->getMapper()->findLicense();
        $this->assertInstanceOf('\GitHub\Resource\Enterprise\License', $license);
        $this->assertRequestUri('/enterprise/settings/license');
    }

    public function testFindStats()
    {
        $this->setMockResponses([[200]]);
        $stats = $this->getMapper()->findStats();
        $this->assertInstanceOf('\GitHub\Resource\Enterprise\Stats', $stats);
        $this->assertRequestUri('/enterprise/stats');
    }
}