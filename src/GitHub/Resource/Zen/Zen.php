<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\Zen;

use GitHub\Resource\ResourceAbstract;

class Zen extends ResourceAbstract
{
    private $message;

    public function __construct(array $data)
    {
        $this->message = array_shift($data);
    }

    public function __toString()
    {
        return $this->getMessage();
    }

    public function getMessage()
    {
        return $this->message;
    }
}
