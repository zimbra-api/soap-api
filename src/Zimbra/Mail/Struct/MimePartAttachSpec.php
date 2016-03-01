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


/**
 * MimePartAttachSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MimePartAttachSpec extends AttachSpec
{
    /**
     * Constructor method for MimePartAttachSpec
     * @param  string $mid Message ID
     * @param  string $part Part
     * @param  bool $optional
     * @return self
     */
    public function __construct($mid, $part, $optional = null)
    {
        parent::__construct($optional);
        $this->setProperty('mid', trim($mid));
        $this->setProperty('part', trim($part));
    }

    /**
     * Gets message id
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->getProperty('mid');
    }

    /**
     * Sets message id
     *
     * @param  string $mid
     * @return self
     */
    public function setMessageId($mid)
    {
        return $this->setProperty('mid', trim($mid));
    }

    /**
     * Gets part
     *
     * @return string
     */
    public function getPart()
    {
        return $this->getProperty('part');
    }

    /**
     * Sets part
     *
     * @param  string $part
     * @return self
     */
    public function setPart($part)
    {
        return $this->setProperty('part', trim($part));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'mp')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'mp')
    {
        return parent::toXml($name);
    }
}
