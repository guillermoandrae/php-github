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

/**
 * Organization resource.
 *
 * @package GitHub\Resource\Organization
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
class Organization extends ResourceAbstract
{
    use LoginAwareTrait;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $billingEmail;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getBillingEmail()
    {
        return $this->billingEmail;
    }
}
