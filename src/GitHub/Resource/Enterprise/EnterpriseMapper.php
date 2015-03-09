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
    public function findAll(array $options = [])
    {

    }

    public function findLicense()
    {
        $uri = '/enterprise/settings/license';
        $results = $this->getAdapter()->get($uri);
        return new License($results);
    }

    public function findStats()
    {
        $uri = '/enterprise/stats';
        $results = $this->getAdapter()->get($uri);
        return new Stats($results);
    }
}
