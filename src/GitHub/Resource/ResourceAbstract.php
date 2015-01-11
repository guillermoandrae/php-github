<?php

namespace GitHub\Resource;

abstract class ResourceAbstract implements ResourceInterface
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __call($method, $arguments = array())
    {
        $prefix = '';
        if ($prefix != 'get') {
            throw new \BadMethodCallException();
        }
        $property = '';
        if (!isset($this->$property)) {
            throw new \BadMethodCallException();
        }
        return $this->$property;
    }
}
