<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

/**
 * Resource collection object.
 *
 * @package GitHub\Resource
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
class Collection implements \Iterator, \IteratorAggregate, \ArrayAccess
{
    /**
     * @var array
     */
    private $collection = [];

    /**
     * @param array $collection
     */
    public function __construct(array $collection = [])
    {
        $this->collection = $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        reset($this->collection);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return current($this->collection);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return key($this->collection);
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return next($this->collection);
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return (null === $this->current());
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($index)
    {
        return array_key_exists($index, $this->collection);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($index)
    {
        unset($this->collection[$index]);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($index, $resource)
    {
        $this->collection[$index] = $resource;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($index)
    {
        return $this->collection[$index];
    }

    public function add(ResourceInterface $resource)
    {
        $this->collection[] = $resource;
        return $this;
    }

    public function count()
    {
        return count($this->collection);
    }
}
