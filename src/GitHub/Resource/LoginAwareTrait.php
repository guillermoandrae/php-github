<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

trait LoginAwareTrait
{
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
     * Return's the entity's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Returns the entity's create date as an object.
     *
     * @param boolean OPTIONAL Whether or not the method should return the datetime string
     * @return \DateTime
     */
    public function getCreatedAt($raw = false)
    {
        if ($raw) {
            return $this->createdAt;
        }
        return new \DateTime($this->createdAt);
    }
}
