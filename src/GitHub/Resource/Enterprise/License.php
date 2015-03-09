<?php
/**
 * This file is part of the php-github package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GitHub\Resource\Enterprise;

use GitHub\Resource\DateTimeAwareTrait;
use GitHub\Resource\ResourceAbstract;

class License extends ResourceAbstract
{
    use DateTimeAwareTrait;

    /**
     * @var int
     */
    protected $seats;

    /**
     * @var int
     */
    protected $seatsUsed;

    /**
     * @var int
     */
    protected $seatsAvailable;

    /**
     * @var string
     */
    protected $kind;

    /**
     * @var int
     */
    protected $daysUntilExpiration;

    /**
     * @var string
     */
    protected $expireAt;

    /**
     * @return int
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @return int
     */
    public function getSeatsUsed()
    {
        return $this->seatsUsed;
    }

    /**
     * @return int
     */
    public function getSeatsAvailable()
    {
        return $this->seatsAvailable;
    }

    /**
     * @return string
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @return int
     */
    public function getDaysUntilExpiration()
    {
        return $this->daysUntilExpiration;
    }

    /**
     * @param boolean $raw
     * @return string
     */
    public function getExpireAt($raw = false)
    {
        return $this->getDateTime($this->expireAt, $raw);
    }
}
