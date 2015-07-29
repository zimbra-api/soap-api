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
 * DateTimeStringAttr struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DateTimeStringAttr extends Base
{
    /**
     * Constructor method for DateTimeStringAttr
     * @param  string $dateTime Date in format : YYYYMMDD[ThhmmssZ]
     * @return self
     */
    public function __construct($dateTime)
    {
        parent::__construct();
        $this->setProperty('d', trim($dateTime));
    }

    /**
     * Gets date time
     *
     * @return int
     */
    public function getDateTime()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets date time
     *
     * @param  int $dateTime
     * @return self
     */
    public function setDateTime($dateTime)
    {
        return $this->setProperty('d', trim($dateTime));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'until')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'until')
    {
        return parent::toXml($name);
    }
}
