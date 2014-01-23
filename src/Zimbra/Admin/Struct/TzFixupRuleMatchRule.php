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
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        $this->property('mon', $mon);

        $week = in_array((int) $week, array(1, 2, 3, 4)) ? (int) $week : -1;
        $this->property('week', $week);

        $wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
        $this->property('wkday', $wkday);
    }

    /**
     * Gets or sets mon
     *
     * @param  int $mon
     * @return int|self
     */
    public function mon($mon = null)
    {
        if(null === $mon)
        {
            return $this->property('mon');
        }
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        return $this->property('mon', $mon);
    }

    /**
     * Gets or sets week
     *
     * @param  int $week
     * @return int|self
     */
    public function week($week = null)
    {
        if(null === $week)
        {
            return $this->property('week');
        }
        $week = in_array((int) $week, array(1, 2, 3, 4)) ? (int) $week : -1;
        return $this->property('week', $week);
    }

    /**
     * Gets or sets wkday
     *
     * @param  int $wkday
     * @return int|self
     */
    public function wkday($wkday = null)
    {
        if(null === $wkday)
        {
            return $this->property('wkday');
        }
        $wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
        return $this->property('wkday', $wkday);
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