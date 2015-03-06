<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

use ICanBoogie\Inflector;

/**
 * Resource mapper abstract.
 *
 * @package GitHub\Resource
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
abstract class ResourceAbstract implements ResourceInterface
{
    /**
     * {@inheritDoc}
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $property = Inflector::get()->camelize($key, true);
            $this->$property = $value;
        }
    }

    /**
     * Invoked when non-existent methods are called.
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($method, $arguments)
    {
        $prefix = strtolower(substr($method, 0, 3));
        if ($prefix !== 'get') {
            $message = sprintf('The %s method does not exist on the \'%s\' object.', $method, get_class($this));
            throw new \BadMethodCallException($message);
        }
        $property = strtolower(substr($method, 3));
        if (!isset($this->$property)) {
            $message = sprintf('The %s property does not exist on the \'%s\' object.', $property, get_class($this));
            throw new \BadMethodCallException($message);
        }
        return $this->$property;
    }
}
