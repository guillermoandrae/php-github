<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHubTest\TestCase;

use GitHub\Resource\ResourceMapperFactory;
use ICanBoogie\Inflector;

class ResourceTestCase extends TestCase implements ResourceNameAwareInterface
{
    /**
     * @var \GitHub\Resource\ResourceInterface
     */
    protected $resource;

    /**
     * @return string
     */
    public function getResourceName()
    {
        $className = get_class($this);
        preg_match('/GitHubTest\\\\Resource\\\\(.*)\\\\/', $className, $matches);
        return $matches[1];
    }

    protected function setUp()
    {
        $name = $this->getResourceName();
        $jsonFilename = Inflector::get()->pluralize(strtolower($name));
        $mockData = $this->getMockData($jsonFilename);
        $this->setMockResponse(200, $mockData);
        $mapper = ResourceMapperFactory::factory($name, $this->getAdapter());
        $collection = $mapper->findAll();
        $this->resource = $collection->current();
    }

    /**
     * @return \GitHub\Resource\ResourceInterface
     */
    protected function getResource()
    {
        return $this->resource;
    }
}
