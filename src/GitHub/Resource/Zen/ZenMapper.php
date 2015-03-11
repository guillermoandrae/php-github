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

/**
 * Zen mapper.
 *
 * @package GitHub\Resource\Zen
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
class ZenMapper extends ResourceMapperAbstract
{
    /**
     * @return Zen
     */
    public function find()
    {
        $result = $this->getAdapter()->get('/zen');
        return new Zen($result);
    }
}
