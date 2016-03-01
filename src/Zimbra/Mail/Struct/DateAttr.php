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
 * DateAttr struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DateAttr extends Base
{
    /**
     * Constructor method for DateAttr
     * @param  string $date Date in format : YYYYMMDDThhmmssZ
     * @return self
     */
    public function __construct($date)
    {
        parent::__construct();
        $this->setProperty('d', trim($date));
    }

    /**
     * Gets date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets date
     *
     * @param  string $date
     * @return self
     */
    public function setDate($date)
    {
        return $this->setProperty('d', trim($date));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'date')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'date')
    {
        return parent::toXml($name);
    }
}
