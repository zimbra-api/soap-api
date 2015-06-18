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
 * TzFixupRuleMatchDate struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TzFixupRuleMatchDate extends Base
{
    /**
     * Constructor method for TzFixupRuleMatchDate
     * @param int $mon Match month. Value between 1 (January) and 12 (December)
     * @param int $mday Match day of month (1..31
     * @return self
     */
    public function __construct($mon, $mday)
    {
        parent::__construct();
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
     * Gets the match month day
     *
     * @return int
     */
    public function getMonthDay()
    {
        return $this->getProperty('mday');
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
        return $this->setProperty('mday', $mday);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'date')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'date')
    {
        return parent::toXml($name);
    }
}