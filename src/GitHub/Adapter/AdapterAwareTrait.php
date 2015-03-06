<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

/**
 * Trait for objects that are aware of the adapter.
 *
 * @package GitHub\Adapter
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
trait AdapterAwareTrait
{
    /**
     * An adapter object.
     *
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @see AdapterAwareInterface::setAdapter()
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @see AdapterAwareInterface::getAdapter()
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
