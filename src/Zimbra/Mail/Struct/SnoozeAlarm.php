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
 * SnoozeAlarm struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SnoozeAlarm extends Base
{
    /**
     * Constructor method for SnoozeAlarm
     * @param string $id Calendar item ID
     * @param int $until When to show the alarm again in milliseconds since the epoch
     * @return self
     */
    public function __construct($id, $until)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('until', (int) $until);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets until
     *
     * @return int
     */
    public function getSnoozeUntil()
    {
        return $this->getProperty('until');
    }

    /**
     * Sets until
     *
     * @param  int $until
     * @return self
     */
    public function setSnoozeUntil($until)
    {
        return $this->setProperty('until', (int) $until);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'alarm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'alarm')
    {
        return parent::toXml($name);
    }
}
