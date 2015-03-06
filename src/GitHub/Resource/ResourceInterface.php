<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

/**
 * Resource object interface.
 *
 * @package GitHub\Resource
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
interface ResourceInterface
{
    /**
     * Builds the resource object.
     *
     * @param array $data
     */
    public function __construct(array $data);
}
