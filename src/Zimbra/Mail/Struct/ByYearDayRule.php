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
 * ByYearDayRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByYearDayRule extends Base
{
    /**
     * Constructor method for ByYearDayRule
     * @param  string $list BYYEARDAY yearday list. Format : [[+]|-]num[,...]" where num is between 1 and 366
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
        return $this->getProperty('yrdaylist');
    }

    /**
     * Sets list
     *
     * @param  string $list
     * @return self
     */
    public function setList($list)
    {
        $yrdaylist = explode(',', $list);
        $arr = array();
        foreach ($yrdaylist as $day)
        {
            if(is_numeric($day))
            {
                $day = (int) $day;
                if($day != 0 && $day > -367 && $day < 367 && !in_array($day, $arr))
                {
                    $arr[] = $day;
                }
            }
        }
        return $this->setProperty('yrdaylist', implode(',', $arr));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byyearday')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byyearday')
    {
        return parent::toXml($name);
    }
}
