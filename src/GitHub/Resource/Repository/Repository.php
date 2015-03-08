<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\Repository;

use GitHub\Resource\DateTimeAwareTrait;
use GitHub\Resource\ResourceAbstract;

class Repository extends ResourceAbstract
{
    use DateTimeAwareTrait;

    /**
     * @var array
     */
    protected $owner;

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
    protected $fullName;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var boolean
     */
    protected $private;

    /**
     * @var boolean
     */
    protected $fork;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $htmlUrl;

    /**
     * @var string
     */
    protected $cloneUrl;

    /**
     * @var string
     */
    protected $gitUrl;

    /**
     * @var string
     */
    protected $sshUrl;

    /**
     * @var string
     */
    protected $svnUrl;

    /**
     * @var string
     */
    protected $mirrorUrl;

    /**
     * @var string
     */
    protected $homepage;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var int
     */
    protected $forksCount;

    /**
     * @var int
     */
    protected $stargazersCount;

    /**
     * @var int
     */
    protected $watchersCount;

    /**
     * @var int
     */
    protected $size;

    /**
     * @var string
     */
    protected $defaultBranch;

    /**
     * @var int
     */
    protected $openIssuesCount;

    /**
     * @var boolean
     */
    protected $hasIssues;

    /**
     * @var boolean
     */
    protected $hasWiki;

    /**
     * @var boolean
     */
    protected $hasPages;

    /**
     * @var boolean
     */
    protected $hasDownloads;

    /**
     * @var string
     */
    protected $pushedAt;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $updatedAt;

    /**
     * @var array
     */
    protected $permissions;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return boolean
     */
    public function isPrivate()
    {
        return $this->private;
    }

    /**
     * @return boolean
     */
    public function isFork()
    {
        return $this->fork;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getHtmlUrl()
    {
        return $this->htmlUrl;
    }

    /**
     * @return string
     */
    public function getCloneUrl()
    {
        return $this->cloneUrl;
    }

    /**
     * @return string
     */
    public function getGitUrl()
    {
        return $this->gitUrl;
    }

    /**
     * @return string
     */
    public function getSshUrl()
    {
        return $this->sshUrl;
    }

    /**
     * @return string
     */
    public function getSvnUrl()
    {
        return $this->svnUrl;
    }

    /**
     * @return string
     */
    public function getMirrorUrl()
    {
        return $this->mirrorUrl;
    }

    /**
     * @return string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return int
     */
    public function getForksCount()
    {
        return $this->forksCount;
    }

    /**
     * @return int
     */
    public function getStargazersCount()
    {
        return $this->stargazersCount;
    }

    /**
     * @return int
     */
    public function getWatchersCount()
    {
        return $this->watchersCount;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getDefaultBranch()
    {
        return $this->defaultBranch;
    }

    /**
     * @return int
     */
    public function getOpenIssuesCount()
    {
        return $this->openIssuesCount;
    }

    /**
     * @return boolean
     */
    public function hasIssues()
    {
        return $this->hasIssues;
    }

    /**
     * @return boolean
     */
    public function hasWiki()
    {
        return $this->hasWiki;
    }

    /**
     * @return boolean
     */
    public function hasPages()
    {
        return $this->hasPages;
    }

    /**
     * @return boolean
     */
    public function hasDownloads()
    {
        return $this->hasDownloads;
    }

    /**
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @return array
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param bool $raw
     * @return \DateTime|string
     */
    public function getPushedAt($raw = false)
    {
        return $this->getDateTime($this->pushedAt, $raw);
    }

    /**
     * @param bool $raw
     * @return \DateTime|string
     */
    public function getCreatedAt($raw = false)
    {
        return $this->getDateTime($this->createdAt, $raw);
    }

    /**
     * @param bool $raw
     * @return \DateTime|string
     */
    public function getUpdatedAt($raw = false)
    {
        return $this->getDateTime($this->updatedAt, $raw);
    }
}
