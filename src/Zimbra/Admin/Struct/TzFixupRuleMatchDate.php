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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * TzFixupRuleMatchDate struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="date")
 */
class TzFixupRuleMatchDate
{
    /**
     * @Accessor(getter="getMonth", setter="setMonth")
     * @SerializedName("mon")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_month;

    /**
     * @Accessor(getter="getMonthDay", setter="setMonthDay")
     * @SerializedName("mday")
     * @Type("integer")
     * @XmlAttribute
     */
    private $_monthDay;

    /**
     * Constructor method for TzFixupRuleMatchDate
     * @param int $mon Match month. Value between 1 (January) and 12 (December)
     * @param int $mday Match day of month (1..31)
     * @return self
     */
    public function __construct($mon, $mday)
    {
        $this->setMonth($mon)
             ->setMonthDay($mday);
    }

    /**
     * Gets the match month
     *
     * @return int
     */
    public function getMonth()
    {
        return $this->_month;
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
        $this->_month = $mon;
        return $this;
    }

    /**
     * Gets the match month day
     *
     * @return int
     */
    public function getMonthDay()
    {
        return $this->_monthDay;
    }

    /**
     * Sets the match month day
     *
     * @param  int $mday
     * @return self
     */
    public function setMonthDay($mday)
    {
        $mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
        $this->_monthDay = $mday;
        return $this;
    }
}