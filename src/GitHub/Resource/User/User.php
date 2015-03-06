<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\User;

use GitHub\Resource\LoginAwareTrait;
use GitHub\Resource\ResourceAbstract;

class User extends ResourceAbstract
{
    use LoginAwareTrait;

    public function isHireable()
    {
        return $this->hireable;
    }

    public function getFollowersUrl()
    {
        return $this->followersUrl;
    }

    public function getFollowingUrl()
    {
        return $this->followingUrl;
    }

    public function isSiteAdmin()
    {
        return $this->siteAdmin;
    }


    public function getSubscriptionsUrl()
    {
        return $this->subscriptionsUrl;
    }

    public function getOrganizationsUrl()
    {
        return $this->organizationsUrl;
    }

    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Returns the entity's create date as an object.
     *
     * @param boolean OPTIONAL Whether or not the method should return the datetime string
     * @return \DateTime
     */
    public function getUpdateddAt($raw = false)
    {
        if ($raw) {
            return $this->updatedAt;
        }
        return new \DateTime($this->updatedAt);
    }
}
