<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Client;

use GitHub\Adapter\AdapterAwareTrait;
use GitHub\Resource\ResourceMapperFactory;

/**
 * GitHub Client.
 *
 * @package GitHub\Client
 */
class Client implements ClientInterface
{
    use AdapterAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function resource($name)
    {
        return ResourceMapperFactory::factory($name, $this->getAdapter());
    }
}
