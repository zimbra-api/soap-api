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
use Zimbra\Struct\TzOnsetInfo;

/**
 * CalTZInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalTZInfo extends Base
{
    /**
     * Constructor method for CalTZInfo
     * @param string $id Timezone ID. If this is the only detail present then this should be an existing server-known timezone's ID Otherwise, it must be present, although it will be ignored by the server
     * @param int $stdoff Standard Time's offset in minutes from UTC; local = UTC + offset
     * @param int $dayoff  Saving Time's offset in minutes from UTC; present only if DST is used
     * @param TzOnsetInfo $standard Time/rule for transitioning from daylight time to standard time. Either specify week/wkday combo, or mday.
     * @param TzOnsetInfo $daylight Time/rule for transitioning from standard time to daylight time
     * @param string $stdname Standard Time component's timezone name
     * @param string $dayname Daylight Saving Time component's timezone name
     * @return self
     */
    public function __construct(
        $id,
        $stdoff,
        $dayoff,
        TzOnsetInfo $standard = null,
        TzOnsetInfo $daylight = null,
        $stdname = null,
        $dayname = null
    )
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('stdoff', (int) $stdoff);
        $this->setProperty('dayoff', (int) $dayoff);
        if($standard instanceof TzOnsetInfo)
        {
            $this->setChild('standard', $standard);
        }
        if($daylight instanceof TzOnsetInfo)
        {
            $this->setChild('daylight', $daylight);
        }
        if(null !== $stdname)
        {
            $this->setProperty('stdname', trim($stdname));
        }
        if(null !== $dayname)
        {
            $this->setProperty('dayname', trim($dayname));
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets stdoff
     *
     * @return int
     */
    public function getTzStdOffset()
    {
        return $this->getProperty('stdoff');
    }

    /**
     * Sets stdoff
     *
     * @param  int $stdoff
     * @return self
     */
    public function setTzStdOffset($stdoff)
    {
        return $this->setProperty('stdoff', (int) $stdoff);
    }

    /**
     * Gets dayoff
     *
     * @return int
     */
    public function getTzDayOffset()
    {
        return $this->getProperty('dayoff');
    }

    /**
     * Sets dayoff
     *
     * @param  int $dayoff
     * @return self
     */
    public function setTzDayOffset($dayoff)
    {
        return $this->setProperty('dayoff', (int) $dayoff);
    }

    /**
     * Gets standard time
     *
     * @return TzOnsetInfo
     */
    public function getStandardTzOnset()
    {
        return $this->getChild('standard');
    }

    /**
     * Sets standard time
     *
     * @param  TzOnsetInfo $standard
     * @return self
     */
    public function setStandardTzOnset(TzOnsetInfo $standard)
    {
        return $this->setChild('standard', $standard);
    }

    /**
     * Gets daylight time
     *
     * @return TzOnsetInfo
     */
    public function getDaylightTzOnset()
    {
        return $this->getChild('daylight');
    }

    /**
     * Sets daylight time
     *
     * @param  TzOnsetInfo $daylight
     * @return self
     */
    public function setDaylightTzOnset(TzOnsetInfo $daylight)
    {
        return $this->setChild('daylight', $daylight);
    }

    /**
     * Gets stdname
     *
     * @return string
     */
    public function getStandardTZName()
    {
        return $this->getProperty('stdname');
    }

    /**
     * Sets stdname
     *
     * @param  string $stdname
     * @return self
     */
    public function setStandardTZName($stdname)
    {
        return $this->setProperty('stdname', trim($stdname));
    }

    /**
     * Gets dayname
     *
     * @return string
     */
    public function getDaylightTZName()
    {
        return $this->getProperty('dayname');
    }

    /**
     * Sets dayname
     *
     * @param  string $dayname
     * @return self
     */
    public function setDaylightTZName($dayname)
    {
        return $this->setProperty('dayname', trim($dayname));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'tz')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'tz')
    {
        return parent::toXml($name);
    }
}
