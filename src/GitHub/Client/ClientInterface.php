<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Client;

use GitHub\Adapter\AdapterInterface;

/**
 * Interface for the GitHub client.
 *
 * @package GitHub\Client
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
interface ClientInterface
{
    /**
     * Returns the mapper object for the desired resource.
     *
     * @param string $name The name of the desired resource
     *
     * @return \GitHub\Resource\ResourceMapperInterface
     */
    public function getResource($name);

    /**
     * Registers an adapter object.
     *
     * @param AdapterInterface $adapter An adapter object
     *
     * @return \GitHub\Client\ClientInterface
     */
    public function setAdapter(AdapterInterface $adapter);

    /**
     * Returns the registered adapter object.
     *
     * @return \GitHub\Adapter\AdapterInterface
     */
    public function getAdapter();
}
