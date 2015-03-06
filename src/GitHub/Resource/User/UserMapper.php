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
    public function find($login)
    {
        $results = $this->getAdapter()->get(sprintf('/users/%s', rawurlencode($login)));
        return new User($results);
    }

    public function findAll($since = null)
    {
        $users = new Collection();
        $results = $this->getAdapter()->get('/users', array('since' => $since));
        foreach ($results as $result) {
            if ($result['type'] === 'User') {
                $users->add(new User($result));
            }
        }
        return $users;
    }
}
