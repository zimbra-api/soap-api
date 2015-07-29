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
 * VCardInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VCardInfo extends Base
{
    /**
     * Constructor method for VCardInfo
     * @param string $value Inlined VCARD data
     * @param string $mid Message ID. Use in conjunction with {part-identifier}
     * @param string $part Part identifier. Use in conjunction with {message-id}
     * @param string $aid Uploaded attachment ID
     * @return self
     */
    public function __construct(
        $value = null,
        $mid = null,
        $part = null,
        $aid = null
    )
    {
        parent::__construct(trim($value));
        if(null !== $mid)
        {
            $this->setProperty('mid', trim($mid));
        }
        if(null !== $part)
        {
            $this->setProperty('part', trim($part));
        }
        if(null !== $aid)
        {
            $this->setProperty('aid', trim($aid));
        }
    }

    /**
     * Gets message Id
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->getProperty('mid');
    }

    /**
     * Sets message Id
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
     * Gets attach Id
     *
     * @return string
     */
    public function getAttachId()
    {
        return $this->getProperty('aid');
    }

    /**
     * Sets attach Id
     *
     * @param  string $aid
     * @return self
     */
    public function setAttachId($aid)
    {
        return $this->setProperty('aid', trim($aid));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'vcard')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'vcard')
    {
        return parent::toXml($name);
    }
}
