<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Client;

use GitHub\Adapter\AdapterAwareInterface;

/**
 * Interface for the GitHub client.
 *
 * @package GitHub\Client
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
interface ClientInterface extends AdapterAwareInterface
{
    /**
     * Returns the mapper object for the desired resource.
     *
     * @param string $name The name of the desired resource
     *
     * @return \GitHub\Resource\ResourceMapperInterface
     */
    public function resource($name);

    /**
     * @see AdapterInterface::setAuthentication()
     */
    public function setAuthentication($username, $password, $authScheme);
}
