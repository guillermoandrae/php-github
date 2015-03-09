<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\Resource\Zen;

use GitHubTest\TestCase\TestCase;

class ZenMapperTest extends TestCase
{
    public function testFind()
    {
        $expectedMessage = 'A Zen test message.';
        $this->setMockResponses([[200, [$expectedMessage]]]);
        $zen = $this->getResourceMapper('zen')->find();
        $this->assertSame($expectedMessage, (string) $zen);
    }
}
