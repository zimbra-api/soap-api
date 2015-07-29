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
 * BySecondRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class BySecondRule extends Base
{
    /**
     * Constructor method for BySecondRule
     * @param  string $list Comma separated list of seconds where second is a number between 0 and 59
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
        return $this->getProperty('seclist');
    }

    /**
     * Sets list
     *
     * @param  string $list
     * @return self
     */
    public function setList($list)
    {
        $seclist = explode(',', $list);
        $arr = array();
        foreach ($seclist as $sec)
        {
            if(is_numeric($sec))
            {
                $sec = (int) $sec;
                if($sec >= 0 && $sec < 60 && !in_array($sec, $arr))
                {
                    $arr[] = $sec;
                }
            }
        }
        return $this->setProperty('seclist', implode(',', $arr));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'bysecond')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'bysecond')
    {
        return parent::toXml($name);
    }
}
