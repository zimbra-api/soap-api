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
 * TimeAttr struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class TimeAttr extends Base
{
    /**
     * Constructor method for TimeAttr
     * @param  string $time end time
     * @return self
     */
    public function __construct($time)
    {
        parent::__construct();
        $this->setProperty('time', trim($time));
    }

    /**
     * Gets end time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->getProperty('time');
    }

    /**
     * Sets end time
     *
     * @param  string $time
     * @return self
     */
    public function setTime($time)
    {
        return $this->setProperty('time', trim($time));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'attr')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'attr')
    {
        return parent::toXml($name);
    }
}
