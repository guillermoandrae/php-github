<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

use GitHub\Adapter\AdapterAwareTrait;

/**
 * Abstract for resource mapper objects.
 *
 * @package GitHub\Resource
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
abstract class ResourceMapperAbstract implements ResourceMapperInterface
{
    use AdapterAwareTrait;

    protected function findCollection($uri, $options)
    {
        preg_match('/(\w+)Mapper/i', get_class($this), $matches);
        $resourceClassName = sprintf('\GitHub\Resource\%s\%s', $matches[1], $matches[1]);
        $collection = new Collection();
        $results = $this->getAdapter()->get($uri, $options);
        foreach ($results as $result) {
            $collection[] = new $resourceClassName($result);
        }
        return $collection;
    }
}
