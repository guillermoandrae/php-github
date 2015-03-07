<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Adapter;

class AdapterFactory
{
    /**
     * @param $name
     * @return AdapterInterface
     * @throws Exception\AdapterNotFoundException
     */
    public static function factory($name)
    {
        try {
            $namespace = '\GitHub\Adapter';
            $className = sprintf('%s\%sAdapter', $namespace, ucfirst($name));
            $reflectionClass = new \ReflectionClass($className);
            $adapter = $reflectionClass->newInstance();
            return $adapter;
        } catch (\ReflectionException $ex) {
            $message = sprintf('The \'%s\' adapter was not found.', $name);
            throw new Exception\AdapterNotFoundException($message);
        }
    }
}
