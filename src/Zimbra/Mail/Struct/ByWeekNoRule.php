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
 * ByWeekNoRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByWeekNoRule extends Base
{
    /**
     * Constructor method for ByWeekNoRule
     * @param  string $list BYWEEKNO Week list. Format : [[+]|-]num[,...] where num is between 1 and 53
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
        return $this->getProperty('wklist');
    }

    /**
     * Sets list
     *
     * @param  string $list
     * @return self
     */
    public function setList($list)
    {
        $wklist = explode(',', $list);
        $arr = array();
        foreach ($wklist as $wk)
        {
            if(is_numeric($wk))
            {
                $wk = (int) $wk;
                if($wk != 0 && $wk > -54 && $wk < 54 && !in_array($wk, $arr))
                {
                    $arr[] = $wk;
                }
            }
        }
        return $this->setProperty('wklist', implode(',', $arr));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byweekno')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byweekno')
    {
        return parent::toXml($name);
    }
}
