<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * @throws Exception\ResourceNotFoundException
     */
    public static function factory($name, AdapterInterface $adapter)
    {
        try {
            $namespace = '\GitHub\Resource';
            $className = sprintf('%s\%s\%sMapper', $namespace, ucfirst($name), ucfirst($name));
            $reflectionClass = new \ReflectionClass($className);
            $resource = $reflectionClass->newInstance();
            $resource->setAdapter($adapter);
            return $resource;
        } catch (\ReflectionException $ex) {
            $message = sprintf('The \'%s\' resource was not found.', $name);
            throw new Exception\ResourceNotFoundException($message);
        }
    }
}
