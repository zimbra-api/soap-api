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
 * ByHourRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ByHourRule extends Base
{
    /**
     * Constructor method for ByHourRule
     * @param  string $list Comma separated list of hours where hour is a number between 0 and 23
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
        return $this->getProperty('hrlist');
    }

    /**
     * Sets list
     *
     * @param  string $list
     * @return self
     */
    public function setList($list)
    {
        $hrlist = explode(',', $list);
        $arr = array();
        foreach ($hrlist as $hr)
        {
            if(is_numeric($hr))
            {
                $hr = (int) $hr;
                if($hr >= 0 && $hr < 24 && !in_array($hr, $arr))
                {
                    $arr[] = $hr;
                }
            }
        }
        return $this->setProperty('hrlist', implode(',', $arr));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'byhour')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'byhour')
    {
        return parent::toXml($name);
    }
}
