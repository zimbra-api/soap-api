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

use Zimbra\Enum\RangeType;
use Zimbra\Struct\Base;

/**
 * ExceptionRecurIdInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExceptionRecurIdInfo extends Base
{
    /**
     * Constructor method for ExceptionRecurIdInfo
     * @param  string $d Date and/or time. Format is : YYYYMMDD['T'HHMMSS[Z]]
     * @param  string $tz Java timezone identifier
     * @param  RangeType $rangeType Range type - 1 means NONE, 2 means THISANDFUTURE, 3 means THISANDPRIOR
     * @return self
     */
    public function __construct($d, $tz = null, RangeType $rangeType = null)
    {
        parent::__construct();
        $this->setProperty('d', trim($d));
        if(null !== $tz)
        {
            $this->setProperty('tz', trim($tz));
        }
        if(null !== $rangeType)
        {
            $this->setProperty('rangeType', $rangeType);
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
     * Gets range type
     *
     * @return RangeType
     */
    public function getRangeType()
    {
        return $this->getProperty('rangeType');
    }

    /**
     * Sets range type
     *
     * @param  RangeType $rangeType
     * @return self
     */
    public function setRangeType(RangeType $rangeType)
    {
        return $this->setProperty('rangeType', $rangeType);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'exceptId')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'exceptId')
    {
        return parent::toXml($name);
    }
}
