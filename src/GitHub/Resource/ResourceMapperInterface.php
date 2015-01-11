<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

use GitHub\Adapter\AdapterInterface;

interface ResourceMapperInterface
{
    public function getAdapter();
    public function setAdapter(AdapterInterface $adapter);
} 