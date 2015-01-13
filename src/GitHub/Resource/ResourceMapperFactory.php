<?php

namespace GitHub\Resource;

use GitHub\Adapter\AdapterInterface;

/**
 * Resource mapper factory.
 *
 * @package GitHub\Resource
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
class ResourceMapperFactory
{
    /**
     * Returns the mapper for the resource with the provided name.
     *
     * @param string $name The name of the desired resource.
     * @param AdapterInterface $adapter
     *
     * @return ResourceMapperInterface
     * @throws Exception\InvalidResourceNameException
     */
    public static function factory($name, AdapterInterface $adapter)
    {
        $namespace = '\GitHub\Resource';
        $className = sprintf('%s\%s\%sMapper', $namespace, ucfirst($name), ucfirst($name));
        try {
            $reflectionClass = new \ReflectionClass($className);
            $resource = $reflectionClass->newInstance($adapter);
        } catch (\Exception $ex) {
            $message = sprintf('"%s" is not the name of a valid GitHub resource.', $name);
            throw new Exception\InvalidResourceNameException($message);
        }
        return $resource;
    }
}
