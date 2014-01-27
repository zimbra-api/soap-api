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
 * ByMinuteRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class ByMinuteRule extends Base
{
    /**
     * Constructor method for ByMinuteRule
     * @param  string $minlist Comma separated list of minutes where minute is a number between 0 and 59
     * @return self
     */
    public function __construct($minlist)
    {
        parent::__construct();
        $minlist = explode(',', $minlist);
        $arr = array();
        foreach ($minlist as $min)
        {
            if(is_numeric($min))
            {
                $min = (int) $min;
                if($min >= 0 && $min < 60 && !in_array($min, $arr))
                {
                    $arr[] = $min;
                }
            }
        }
        $this->property('minlist', implode(',', $arr));
    }

    /**
     * Gets or sets minlist
     *
     * @param  string $minlist
     * @return string|self
     */
    public function minlist($minlist = null)
    {
        if(null === $minlist)
        {
            return $this->property('minlist');
        }
        $minlist = explode(',', $minlist);
        $arr = array();
        foreach ($minlist as $min)
        {
            if(is_numeric($min))
            {
                $min = (int) $min;
                if($min >= 0 && $min < 60 && !in_array($min, $arr))
                {
                    $arr[] = $min;
                }
            }
        }
        return $this->property('minlist', implode(',', $arr));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byminute')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byminute')
    {
        return parent::toXml($name);
    }
}
