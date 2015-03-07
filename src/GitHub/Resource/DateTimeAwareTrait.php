<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource;

trait DateTimeAwareTrait
{
    /**
     * Returns the entity's create date as an object.
     *
     * @param string $datetime  A date/time string
     * @param boolean $raw  OPTIONAL Whether or not the method should return the datetime string
     * @return \DateTime|string
     */
    public function getDateTime($datetime, $raw = false)
    {
        if ($raw) {
            return $datetime;
        }
        return new \DateTime($datetime);
    }
}
