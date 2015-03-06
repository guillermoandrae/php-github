<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

use GitHub\Adapter\AdapterAwareTrait;

/**
 * Abstract for resource mapper objects.
 *
 * @package GitHub\Resource
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
abstract class ResourceMapperAbstract implements ResourceMapperInterface
{
    use AdapterAwareTrait;
}
