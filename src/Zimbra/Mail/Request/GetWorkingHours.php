<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

/**
 * GetWorkingHours request class
 * User's working hours within the given time range are expressed in a similar format to the format used for GetFreeBusy. 
 * Working hours are indicated as free, non-working hours as unavailable/out of office.
 * The entire time range is marked as unknown if there was an error determining the working hours, e.g. unknown user.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetWorkingHours extends Base
{
    /**
     * Constructor method for GetWorkingHours
     * @param  int $startTime
     * @param  int $endTime
     * @param  string $id
     * @param  string $name
     * @return self
     */
    public function __construct($startTime, $endTime, $id = null, $name = null)
    {
        parent::__construct();
        $this->setProperty('s', (int) $startTime);
        $this->setProperty('e', (int) $endTime);
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
    }

    /**
     * Gets range start in milliseconds since the epoch
     *
     * @return int
     */
    public function getStartTime()
    {
        return $this->getProperty('s');
    }

    /**
     * Sets range start in milliseconds since the epoch
     *
     * @param  int $startTime
     * @return self
     */
    public function setStartTime($startTime)
    {
        return $this->setProperty('s', (int) $startTime);
    }

    /**
     * Gets range end in milliseconds since the epoch
     *
     * @return int
     */
    public function getEndTime()
    {
        return $this->getProperty('e');
    }

    /**
     * Sets range end in milliseconds since the epoch
     *
     * @param  int $endTime
     * @return self
     */
    public function setEndTime($endTime)
    {
        return $this->setProperty('e', (int) $endTime);
    }

    /**
     * Gets comma-separated list of Zimbra IDs
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets comma-separated list of Zimbra IDs
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets comma-separated list of email addresses
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets comma-separated list of email addresses
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }
}
