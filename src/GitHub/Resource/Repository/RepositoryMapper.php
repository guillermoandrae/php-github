<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\Repository;

use GitHub\Resource\Collection;
use GitHub\Resource\ResourceMapperAbstract;

class RepositoryMapper extends ResourceMapperAbstract
{
    public function findAll($since = '')
    {
        $results = $this->getAdapter()->get('/repositories', ['since' => $since]);
        return $this->buildCollection($results);
    }

    public function findByUser($login, array $options = [])
    {
        $uri = sprintf('/users/%s/repos', rawurlencode($login));
        $results = $this->getAdapter()->get($uri, $options);
        return $this->buildCollection($results);
    }

    public function findByOrganization($login, array $options = [])
    {
        $uri = sprintf('/orgs/%s/repos', rawurlencode($login));
        $results = $this->getAdapter()->get($uri, $options);
        return $this->buildCollection($results);
    }

    private function buildCollection($results)
    {
        $repositories = new Collection();
        foreach ($results as $result) {
            $repositories[] = new Repository($result);
        }
        return $repositories;
    }
}
