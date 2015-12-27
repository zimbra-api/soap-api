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
 * InstanceRecurIdInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class InstanceRecurIdInfo extends Base
{
    /**
     * Constructor method for AccountACEInfo
     * @param string $range Range - THISANDFUTURE|THISANDPRIOR
     * @param string $d Date and/or time. Format is : YYYYMMDD['T'HHMMSS[Z]] 
     * @param string $tz Java timezone identifier
     * @return self
     */
    public function __construct(
        $range = null,
        $date = null,
        $tz = null
    )
    {
        parent::__construct();
        if(null !== $range)
        {
            $this->setProperty('range', trim($range));
        }
        if(null !== $date)
        {
            $this->setProperty('d', trim($date));
        }
        if(null !== $tz)
        {
            $this->setProperty('tz', trim($tz));
        }
    }

    /**
     * Gets range
     *
     * @return string
     */
    public function getRange()
    {
        return $this->getProperty('range');
    }

    /**
     * Sets range
     *
     * @param  string $range
     * @return self
     */
    public function setRange($range)
    {
        return $this->setProperty('range', trim($range));
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
     * Gets timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->getProperty('tz');
    }

    /**
     * Sets timezone
     *
     * @param  string $tz
     * @return self
     */
    public function setTimezone($tz)
    {
        return $this->setProperty('tz', trim($tz));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'inst')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'inst')
    {
        return parent::toXml($name);
    }
}
