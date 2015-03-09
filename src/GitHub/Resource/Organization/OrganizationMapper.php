<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\Organization;

use GitHub\Resource\Collection;
use GitHub\Resource\ResourceMapperAbstract;

class OrganizationMapper extends ResourceMapperAbstract
{
    /**
     * @param $login
     * @return Organization
     */
    public function find($login)
    {
        $results = $this->getAdapter()->get(sprintf('/orgs/%s', rawurlencode($login)));
        return new Organization($results);
    }

    /**
     * @param array $options  OPTIONAL
     * @return Collection
     */
    public function findAll(array $options = [])
    {
        $orgs = new Collection();
        $results = $this->getAdapter()->get('/users', $options);
        foreach ($results as $result) {
            if ($result['type'] === 'Organization') {
                $orgs->add(new Organization($result));
            }
        }
        return $orgs;
    }
}
