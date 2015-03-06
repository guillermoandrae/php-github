<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\User;

use GitHub\Resource\Collection;
use GitHub\Resource\ResourceMapperAbstract;

class UserMapper extends ResourceMapperAbstract
{
    public function find($username)
    {
        $results = $this->getAdapter()->get(sprintf('/users/%s', rawurlencode($username)));
        return new User($results);
    }

    public function findAll($since = null, $offset = 0, $limit = null)
    {
        $users = new Collection();
        $results = $this->getAdapter()->get('/users', array('since' => $since));
        foreach ($results as $result) {
            $users->add(new User($result));
        }
        return $users;
    }
}
