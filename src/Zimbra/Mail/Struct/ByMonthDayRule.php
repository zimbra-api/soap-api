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
 * ByMonthDayRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByMonthDayRule extends Base
{
    /**
     * Constructor method for ByMonthDayRule
     * @param  string $list
     *   Comma separated list of day numbers from either the start (positive) or the end (negative) of the month - format : [[+]|-]num[,...] where num between 1 to 31 
     *   e.g. modaylist="1,+2,-7" means first day of the month, plus the 2nd day of the month, plus the 7th from last day of the month.
     * @return self
     */
    public function __construct($list)
    {
        parent::__construct();
        $this->setList($list);
    }

    /**
     * Gets list
     *
     * @return string
     */
    public function getList()
    {
        return $this->getProperty('modaylist');
    }

    /**
     * Sets list
     *
     * @param  string $list
     * @return self
     */
    public function setList($list)
    {
        $modaylist = explode(',', $list);
        $arr = array();
        foreach ($modaylist as $day)
        {
            if(is_numeric($day))
            {
                $day = (int) $day;
                if($day != 0 && $day > -32 && $day < 32 && !in_array($day, $arr))
                {
                    $arr[] = $day;
                }
            }
        }
        return $this->setProperty('modaylist', implode(',', $arr));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'bymonthday')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'bymonthday')
    {
        return parent::toXml($name);
    }
}
