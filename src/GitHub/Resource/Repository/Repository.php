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
    private $owner;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $description;

    /**
     * @var boolean
     */
    private $private;

    /**
     * @var boolean
     */
    private $fork;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $htmlUrl;

    /**
     * @var string
     */
    private $cloneUrl;

    /**
     * @var string
     */
    private $gitUrl;

    /**
     * @var string
     */
    private $sshUrl;

    /**
     * @var string
     */
    private $svnUrl;

    /**
     * @var string
     */
    private $mirrorUrl;

    /**
     * @var string
     */
    private $homepage;

    /**
     * @var string
     */
    private $language;

    /**
     * @var int
     */
    private $forksCount;

    /**
     * @var int
     */
    private $stargazersCount;

    /**
     * @var int
     */
    private $watchersCount;

    /**
     * @var int
     */
    private $size;

    /**
     * @var string
     */
    private $defaultBranch;

    /**
     * @var int
     */
    private $openIssuesCount;

    /**
     * @var boolean
     */
    private $hasIssues;

    /**
     * @var boolean
     */
    private $hasWiki;

    /**
     * @var boolean
     */
    private $hasPages;

    /**
     * @var boolean
     */
    private $hasDownloads;

    /**
     * @var string
     */
    private $pushedAt;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

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
    public function isHasIssues()
    {
        return $this->hasIssues;
    }

    /**
     * @return boolean
     */
    public function isHasWiki()
    {
        return $this->hasWiki;
    }

    /**
     * @return boolean
     */
    public function isHasPages()
    {
        return $this->hasPages;
    }

    /**
     * @return boolean
     */
    public function isHasDownloads()
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
     * @var array
     */
    private $permissions;

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
