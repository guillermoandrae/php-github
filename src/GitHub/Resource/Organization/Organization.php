<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\Organization;

use GitHub\Resource\LoginAwareTrait;
use GitHub\Resource\ResourceAbstract;

class Organization extends ResourceAbstract
{
    use LoginAwareTrait;

    public function getDescription()
    {
        return $this->description;
    }

    public function getBillingEmail()
    {
        return $this->billingEmail;
    }
}
