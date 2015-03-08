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
use GitHub\Resource\ResourceMapperFactory;

class RepositoryMapper extends ResourceMapperAbstract
{
    public function findAll(array $options = [])
    {
        return $this->findCollection('/repositories', $options);
    }

    public function findMine(array $options = [])
    {
        return $this->findCollection('/user/repos', $options);
    }

    public function findByUser($login, array $options = [])
    {
        $uri = sprintf('/users/%s/repos', rawurlencode($login));
        return $this->findCollection($uri, $options);
    }

    public function findByOrganization($login, array $options = [])
    {
        $uri = sprintf('/orgs/%s/repos', rawurlencode($login));
        return $this->findCollection($uri, $options);
    }

    protected function findCollection($uri, $options)
    {
        preg_match('/(\w+)Mapper/i', get_class($this), $matches);
        $collection = new Collection();
        $results = $this->getAdapter()->get($uri, $options);
        foreach ($results as $result) {
            $login = $result['owner']['login'];
            $result['owner'] = ResourceMapperFactory::factory('user', $this->getAdapter())->find($login);
            $collection[] = new Repository($result);
        }
        return $collection;
    }
}
