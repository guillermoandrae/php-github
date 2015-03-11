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

/**
 * User mapper.
 *
 * @package GitHub\Resource\User
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
class UserMapper extends ResourceMapperAbstract
{
    /**
     * @param $login
     * @return User
     */
    public function find($login)
    {
        $results = $this->getAdapter()->get(sprintf('/users/%s', rawurlencode($login)));
        return new User($results);
    }

    /**
     * @return User
     */
    public function findMe()
    {
        $results = $this->getAdapter()->get('/user');
        return new User($results);
    }

    /**
     * @param array $options
     * @return Collection
     */
    public function findAll(array $options = [])
    {
        $users = new Collection();
        $results = $this->getAdapter()->get('/users', $options);
        foreach ($results as $result) {
            if ($result['type'] === 'User') {
                $users->add(new User($result));
            }
        }
        return $users;
    }
}
