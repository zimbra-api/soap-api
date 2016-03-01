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
 * DismissAlarm struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DismissAlarm extends Base
{
    /**
     * Constructor method for DismissAlarm
     * @param string $id Calendar item ID
     * @param int $dismissedAt Time alarm was dismissed, in millis
     * @return self
     */
    public function __construct($id, $dismissedAt)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('dismissedAt', (int) $dismissedAt);
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
     * Gets version2
     *
     * @return int
     */
    public function getDismissedAt()
    {
        return $this->getProperty('dismissedAt');
    }

    /**
     * Sets version2
     *
     * @param  int $dismissedAt
     * @return self
     */
    public function setDismissedAt($dismissedAt)
    {
        return $this->setProperty('dismissedAt', (int) $dismissedAt);
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
