<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

/**
 * Trait for resources associated with a login name.
 *
 * @package GitHub\Resource
 * @author Guillermo A. Fisher <me@guillermoandraefisher.com>
 */
trait LoginAwareTrait
{
    use DateTimeAwareTrait;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $company;

    /**
     * @var string
     */
    protected $blog;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $avatarUrl;

    /**
     * @var int
     */
    protected $publicRepos;

    /**
     * @var int
     */
    protected $publicGists;

    /**
     * @var int
     */
    protected $followers;

    /**
     * @var int
     */
    protected $following;

    /**
     * @var int
     */
    protected $totalPrivateRepos;

    /**
     * @var int
     */
    protected $ownedPrivateRepos;

    /**
     * @var int
     */
    protected $privateGists;

    /**
     * @var int
     */
    protected $diskUsage;

    /**
     * @var array
     */
    protected $plan;

    /**
     * @var string
     */
    protected $htmlUrl;

    /**
     * @var int
     */
    protected $collaborators;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @return int
     */
    public function getNumPublicRepos()
    {
        return $this->publicRepos;
    }

    /**
     * @return int
     */
    public function getNumPublicGists()
    {
        return $this->publicGists;
    }

    /**
     * @return int
     */
    public function getNumFollowers()
    {
        return $this->followers;
    }

    /**
     * @return int
     */
    public function getNumFollowing()
    {
        return $this->following;
    }

    /**
     * @return int
     */
    public function getNumPrivateRepos()
    {
        return $this->totalPrivateRepos;
    }

    /**
     * @return int
     */
    public function getNumOwnedPrivateRepos()
    {
        return $this->ownedPrivateRepos;
    }

    /**
     * @return int
     */
    public function getNumPrivateGists()
    {
        return $this->privateGists;
    }

    /**
     * @return int
     */
    public function getNumCollaborators()
    {
        return $this->collaborators;
    }

    /**
     * Returns the entity's login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return's the entity's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return string
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Returns the entity's type (within the context of GitHub).
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the entity's e-mail address.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the entity's URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Returns the URL to the entity's avatar.
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @return int
     */
    public function getDiskUsage()
    {
        return $this->diskUsage;
    }

    /**
     * @return array
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * @return string
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }

    /**
     * @param bool $raw
     * @return \DateTime|string
     */
    public function getCreatedAt($raw = false)
    {
        return $this->getDateTime($this->createdAt, $raw);
    }
}
