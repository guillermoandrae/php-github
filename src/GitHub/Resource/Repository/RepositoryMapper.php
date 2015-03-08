<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\Repository;

use GitHub\Resource\ResourceMapperAbstract;

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
}
