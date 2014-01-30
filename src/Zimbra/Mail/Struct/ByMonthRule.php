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
 * ByMonthRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByMonthRule extends Base
{
    /**
     * Constructor method for ByMonthRule
     * @param  string $molist Comma separated list of months where month is a number between 1 and 12
     * @return self
     */
    public function __construct($molist)
    {
        parent::__construct();
        $molist = explode(',', $molist);
        $arr = array();
        foreach ($molist as $mo)
        {
            if(is_numeric($mo))
            {
                $mo = (int) $mo;
                if($mo > 0 && $mo < 13 && !in_array($mo, $arr))
                {
                    $arr[] = $mo;
                }
            }
        }
        $this->property('molist', implode(',', $arr));
    }

    /**
     * Gets or sets molist
     *
     * @param  string $molist
     * @return string|self
     */
    public function molist($molist = null)
    {
        if(null === $molist)
        {
            return $this->property('molist');
        }
        $molist = explode(',', $molist);
        $arr = array();
        foreach ($molist as $mo)
        {
            if(is_numeric($mo))
            {
                $mo = (int) $mo;
                if($mo > 0 && $mo < 13 && !in_array($mo, $arr))
                {
                    $arr[] = $mo;
                }
            }
        }
        return $this->property('molist', implode(',', $arr));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'bymonth')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'bymonth')
    {
        return parent::toXml($name);
    }
}
