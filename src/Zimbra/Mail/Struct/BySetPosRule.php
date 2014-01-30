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
 * BySetPosRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class BySetPosRule extends Base
{
    /**
     * Constructor method for BySetPosRule
     * @param  string $poslist Format [[+]|-]num[,...] where num is from 1 to 366 
     * @return self
     */
    public function __construct($poslist)
    {
        parent::__construct();
        $poslist = explode(',', $poslist);
        $arr = array();
        foreach ($poslist as $day)
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
        $this->property('poslist', implode(',', $arr));
    }

    /**
     * Gets or sets poslist
     *
     * @param  string $poslist
     * @return string|self
     */
    public function poslist($poslist = null)
    {
        if(null === $poslist)
        {
            return $this->property('poslist');
        }
        $poslist = explode(',', $poslist);
        $arr = array();
        foreach ($poslist as $day)
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
        return $this->property('poslist', implode(',', $arr));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'bysetpos')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'bysetpos')
    {
        return parent::toXml($name);
    }
}
