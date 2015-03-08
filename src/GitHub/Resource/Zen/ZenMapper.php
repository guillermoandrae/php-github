<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\Zen;

use GitHub\Resource\Collection;
use GitHub\Resource\ResourceMapperAbstract;

class ZenMapper extends ResourceMapperAbstract
{
    public function findOne()
    {
        return $this->findAll()[0];
    }

    public function findAll(array $options = [])
    {
        $result = $this->getAdapter()->get('/zen');
        return new Collection([new Zen($result)]);
    }
}
