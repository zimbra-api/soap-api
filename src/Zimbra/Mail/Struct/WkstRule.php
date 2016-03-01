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
 * WkstRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class WkstRule extends Base
{
    /**
     * Constructor method for WkstRule
     * @param  WeekDay $day Weekday - SU|MO|TU|WE|TH|FR|SA
     * @return self
     */
    public function __construct(WeekDay $day)
    {
        parent::__construct();
        $this->setProperty('day', $day);
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
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'wkst')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'wkst')
    {
        return parent::toXml($name);
    }
}
