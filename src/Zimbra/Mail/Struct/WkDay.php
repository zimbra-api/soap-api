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

use Zimbra\Enum\WeekDay;
use Zimbra\Struct\Base;

/**
 * WkDay struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class WkDay extends Base
{
    /**
     * Constructor method for WkDay
     * @param  WeekDay $day Weekday - SU|MO|TU|WE|TH|FR|SA
     * @param  int $ordwk Week number. [[+]|-]num num: 1 to 53
     * @return self
     */
    public function __construct(WeekDay $day, $ordwk = null)
    {
        parent::__construct();
        $this->setProperty('day', $day);
        if(null !== $ordwk)
        {
            $this->setOrdWk($ordwk);
        }
    }

    /**
     * Gets weekday
     *
     * @return WeekDay
     */
    public function getDay()
    {
        return $this->getProperty('day');
    }

    /**
     * Sets weekday
     *
     * @param  WeekDay $day
     * @return self
     */
    public function setDay(WeekDay $day)
    {
        return $this->setProperty('day', $day);
    }

    /**
     * Gets week number
     *
     * @return bool
     */
    public function getOrdWk()
    {
        return $this->getProperty('ordwk');
    }

    /**
     * Sets week number
     *
     * @param  bool $ordwk
     * @return self
     */
    public function setOrdWk($ordwk)
    {
        $ordwk = (int) $ordwk;
        if($ordwk != 0 && $ordwk > -54 && $ordwk < 54)
        {
            $this->setProperty('ordwk', $ordwk);
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'wkday')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'wkday')
    {
        return parent::toXml($name);
    }
}
