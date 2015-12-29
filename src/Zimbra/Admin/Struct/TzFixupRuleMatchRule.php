<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Struct\Base;

/**
 * TzFixupRuleMatchRule struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzFixupRuleMatchRule extends Base
{
    /**
     * Constructor method for TzFixupRuleMatchRule
     * @param int $mon Match month. Value between 1 (January) and 12 (December)
     * @param int $week Match week. -1 means last week of month else between 1 and 4
     * @param int $wkday Match week day. Value between 1 (Sunday) and 7 (Saturday)
     * @return self
     */
    public function __construct($mon, $week, $wkday)
    {
        parent::__construct();
        $this->setMonth($mon)
             ->setWeek($week)
             ->setWeekDay($wkday);
    }

    /**
     * Gets the match month
     *
     * @return int
     */
    public function getMonth()
    {
        return $this->getProperty('mon');
    }

    /**
     * Sets the match month
     *
     * @param  int $mon
     * @return self
     */
    public function setMonth($mon)
    {
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        return $this->setProperty('mon', $mon);
    }

    /**
     * Gets the match week
     *
     * @return int
     */
    public function getWeek()
    {
        return $this->getProperty('week');
    }

    /**
     * Sets the match week
     *
     * @param  int $week
     * @return self
     */
    public function setWeek($week)
    {
        $week = in_array((int) $week, [1, 2, 3, 4]) ? (int) $week : -1;
        return $this->setProperty('week', $week);
    }

    /**
     * Gets the match week day
     *
     * @return int
     */
    public function getWeekDay()
    {
        return $this->getProperty('wkday');
    }

    /**
     * Sets the match week day
     *
     * @param  int $wkday
     * @return self
     */
    public function setWeekDay($wkday)
    {
        $wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
        return $this->setProperty('wkday', $wkday);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'rule')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'rule')
    {
        return parent::toXml($name);
    }
}
