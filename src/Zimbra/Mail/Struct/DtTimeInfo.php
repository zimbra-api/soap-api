<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * DtTimeInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DtTimeInfo extends Base
{
    /**
     * Constructor method for DtTimeInfo
     * @param string $date Date and/or time. Format is : YYYYMMDD['T'HHMMSS[Z]] 
     * @param string $tz Java timezone identifier
     * @param int $u UTC time as milliseconds since the epoch. Set if non-all-day
     * @return self
     */
    public function __construct(
        $d = null,
        $tz = null,
        $u = null
    )
    {
        parent::__construct();
        if(null !== $d)
        {
            $this->setProperty('d', trim($d));
        }
        if(null !== $tz)
        {
            $this->setProperty('tz', trim($tz));
        }
        if(null !== $u)
        {
            $this->setProperty('u', (int) $u);
        }
    }

    /**
     * Gets date time
     *
     * @return string
     */
    public function getDateTime()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets date time
     *
     * @param  string $d
     * @return self
     */
    public function setDateTime($d)
    {
        return $this->setProperty('d', trim($d));
    }

    /**
     * Gets time zone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->getProperty('tz');
    }

    /**
     * Sets time zone
     *
     * @param  string $tz
     * @return self
     */
    public function setTimezone($tz)
    {
        return $this->setProperty('tz', trim($tz));
    }

    /**
     * Gets utc time
     *
     * @return int
     */
    public function getUtcTime()
    {
        return $this->getProperty('u');
    }

    /**
     * Sets utc time
     *
     * @param  int $u
     * @return self
     */
    public function setUtcTime($u)
    {
        return $this->setProperty('u', (int) $u);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'dt')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'dt')
    {
        return parent::toXml($name);
    }
}