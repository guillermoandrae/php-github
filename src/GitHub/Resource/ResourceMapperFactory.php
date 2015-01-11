<?php

namespace GitHub\Resource;

use GitHub\Adapter\AdapterInterface;

class ResourceMapperFactory
{
    /**
     * @param string $name
     * @param AdapterInterface $adapter
     *
     * @return ResourceMapperInterface
     * @throws Exception\InvalidResourceException
     */
    public static function factory($name, AdapterInterface $adapter)
    {
        $namespace = '\GitHub\Resource';
        $className = sprintf('%s\%s\%sMapper', $namespace, ucfirst($name), ucfirst($name));
        try {
            $reflectionClass = new \ReflectionClass($className);
            $resource = $reflectionClass->newInstance($adapter);
        } catch (\Exception $ex) {
            throw new Exception\InvalidResourceException(sprintf('"%s" is an invalid GitHub resource.', $name));
        }
        return $resource;
    }
}
