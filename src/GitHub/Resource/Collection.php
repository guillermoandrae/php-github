<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

class Collection implements \ArrayAccess
{
    private $collection = [];

    public function offsetSet($offset, $value)
    {
        if (!is_a($value, '\GitHub\Resource\ResourceInterface')) {
            throw new \Exception();
        }
        if (is_null($offset)) {
            $this->collection[] = $value;
        } else {
            $this->collection[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->collection[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->collection[$offset]) ? $this->collection[$offset] : null;
    }

    public function offsetUnset($offset)
    {
        unset($this->collection[$offset]);
    }
}
