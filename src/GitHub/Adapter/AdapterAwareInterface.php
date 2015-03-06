<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

/**
 * Interface for objects that are aware of the adapter.
 *
 * @package GitHub\Adapter
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
interface AdapterAwareInterface
{
    /**
     * Registers an adapter object.
     *
     * @param AdapterInterface $adapter An adapter object
     *
     * @return AdapterAwareInterface
     */
    public function setAdapter(AdapterInterface $adapter);

    /**
     * Returns the registered adapter object.
     *
     * @return AdapterInterface
     */
    public function getAdapter();
}
