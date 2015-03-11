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

/**
 * User resource.
 *
 * @package GitHub\Resource\User
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
class User extends ResourceAbstract
{
    use LoginAwareTrait;

    /**
     * @var string
     */
    protected $gistsUrl;

    /**
     * @var string
     */
    protected $starredUrl;

    /**
     * @var string
     */
    protected $subscriptionsUrl;

    /**
     * @var string
     */
    protected $organizationsUrl;

    /**
     * @var string
     */
    protected $reposUrl;

    /**
     * @var string
     */
    protected $eventsUrl;

    /**
     * @var string
     */
    protected $receivedEventsUrl;

    /**
     * @var boolean
     */
    protected $siteAdmin;

    /**
     * @var boolean
     */
    protected $hireable;

    /**
     * @var string
     */
    protected $bio;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $followersUrl;

    /**
     * @var string
     */
    protected $followingUrl;

    /**
     * @return bool
     */
    public function isHireable()
    {
        return $this->hireable;
    }

    /**
     * @return bool
     */
    public function isSiteAdmin()
    {
        return $this->siteAdmin;
    }

    /**
     * @return string
     */
    public function getSubscriptionsUrl()
    {
        return $this->subscriptionsUrl;
    }

    /**
     * @return string
     */
    public function getOrganizationsUrl()
    {
        return $this->organizationsUrl;
    }

    /**
     * @return string
     */
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
    public function getUpdatedAt($raw = false)
    {
        return $this->getDateTime($this->updatedAt, $raw);
    }

    /**
     * @return string
     */
    public function getGistsUrl()
    {
        return $this->gistsUrl;
    }

    /**
     * @return string
     */
    public function getStarredUrl()
    {
        return $this->starredUrl;
    }

    /**
     * @return string
     */
    public function getReposUrl()
    {
        return $this->reposUrl;
    }

    /**
     * @return string
     */
    public function getEventsUrl()
    {
        return $this->eventsUrl;
    }

    /**
     * @return string
     */
    public function getReceivedEventsUrl()
    {
        return $this->receivedEventsUrl;
    }

    /**
     * @return string
     */
    public function getFollowersUrl()
    {
        return $this->followersUrl;
    }

    /**
     * @return string
     */
    public function getFollowingUrl()
    {
        return $this->followingUrl;
    }
}
