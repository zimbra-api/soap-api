<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * SharedReminderMount class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SharedReminderMount
{
    /**
     * Mountpoint ID
     * @var string
     */
    private $_id;

    /**
     * Set to enable (or unset to disable) reminders for shared appointments/tasks
     * @var bool
     */
    private $_reminder;

    /**
     * Constructor method for SharedReminderMount
     * @param string $id
     * @param bool $reminder
     * @return self
     */
    public function __construct($id, $reminder = null)
    {
        $this->_id = trim($id);
        if(null !== $reminder)
        {
            $this->_reminder = (bool) $reminder;
        }
    }

    /**
     * Get or set id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Get or set reminder
     *
     * @param  bool $reminder
     * @return bool|self
     */
    public function reminder($reminder = null)
    {
        if(null === $reminder)
        {
            return $this->_reminder;
        }
        $this->_reminder = (bool) $reminder;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'link')
    {
        $name = !empty($name) ? $name : 'link';
        $arr =  array(
            'id' => $this->_id,
        );
        if(is_bool($this->_reminder))
        {
            $arr['reminder'] = $this->_reminder ? 1 : 0;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'link')
    {
        $name = !empty($name) ? $name : 'link';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id);
        if(is_bool($this->_reminder))
        {
            $xml->addAttribute('reminder', $this->_reminder ? 1 : 0);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
