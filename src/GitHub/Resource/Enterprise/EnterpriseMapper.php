<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\Enterprise;

use GitHub\Resource\ResourceMapperAbstract;

class EnterpriseMapper extends ResourceMapperAbstract
{
    public function findLicense()
    {
        $uri = '/enterprise/settings/license';
        $results = $this->getAdapter()->get($uri);
        return new License($results);
    }
}
