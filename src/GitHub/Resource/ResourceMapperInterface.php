<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

use GitHub\Adapter\AdapterAwareInterface;

/**
 * Interface for resource mapper objects.
 *
 * @package GitHub\Adapter
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
interface ResourceMapperInterface extends AdapterAwareInterface
{
    public function findAll(array $options = []);
}
