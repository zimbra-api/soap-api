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
 * RecurIdInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RecurIdInfo extends Base
{
    /**
     * Constructor method for RecurIdInfo
     * @param int $rangeType Recurrence range type
     * @param string $recurId Recurrence ID in format : YYMMDD[THHMMSS[Z]]
     * @param string $tz Timezone name
     * @param string $ridZ Recurrence-id in UTC time zone; used in non-all-day appointments only 
     * @return self
     */
    public function __construct(
        $rangeType,
        $recurId,
        $tz = null,
        $ridZ = null
    )
    {
        parent::__construct();
        $this->setProperty('rangeType', (int) $rangeType);
        $this->setProperty('recurId', trim($recurId));
        if(null !== $tz)
        {
            $this->setProperty('tz', trim($tz));
        }
        if(null !== $ridZ)
        {
            $this->setProperty('ridZ', trim($ridZ));
        }
    }

    /**
     * Gets recurrence range type
     *
     * @return string
     */
    public function getRecurrenceRangeType()
    {
        return $this->getProperty('rangeType');
    }

    /**
     * Sets recurrence range type
     *
     * @param  string $rangeType
     * @return self
     */
    public function setRecurrenceRangeType($rangeType)
    {
        return $this->setProperty('rangeType', (int) $rangeType);
    }

    /**
     * Gets recurrence ID
     *
     * @return string
     */
    public function getRecurrenceId()
    {
        return $this->getProperty('recurId');
    }

    /**
     * Sets recurrence ID
     *
     * @param  string $recurId
     * @return self
     */
    public function setRecurrenceId($recurId)
    {
        return $this->setProperty('recurId', trim($recurId));
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
     * Gets recurrence-id in UTC time zone
     *
     * @return string
     */
    public function getRecurIdZ()
    {
        return $this->getProperty('ridZ');
    }

    /**
     * Sets recurrence-id in UTC time zone
     *
     * @param  string $ridZ
     * @return self
     */
    public function setRecurIdZ($ridZ)
    {
        return $this->setProperty('ridZ', trim($ridZ));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'recur')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'recur')
    {
        return parent::toXml($name);
    }
}
