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
 * ContentSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ContentSpec extends Base
{
    /**
     * Constructor method for ContentSpec
     * @param string $value Inlined content data. Ignored if "aid" or "mid"/"part" specified
     * @param string $aid Attachment upload ID of uploaded object to use
     * @param string $mid Message ID of existing message. Used in conjunction with "part"
     * @param string $part Part identifier. This combined with "mid" identifies a part of an existing message
     * @return self
     */
    public function __construct(
        $value = null,
        $aid = null,
        $mid = null,
        $part = null
    )
    {
        parent::__construct(trim($value));
        if(null !== $aid)
        {
            $this->setProperty('aid', trim($aid));
        }
        if(null !== $mid)
        {
            $this->setProperty('mid', trim($mid));
        }
        if(null !== $part)
        {
            $this->setProperty('part', trim($part));
        }
    }

    /**
     * Gets aid
     *
     * @return string
     */
    public function getAttachmentId()
    {
        return $this->getProperty('aid');
    }

    /**
     * Sets aid
     *
     * @param  string $aid
     * @return self
     */
    public function setAttachmentId($aid)
    {
        return $this->setProperty('aid', trim($aid));
    }

    /**
     * Gets mid
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->getProperty('mid');
    }

    /**
     * Sets mid
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
    public function toArray($name = 'content')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'content')
    {
        return parent::toXml($name);
    }
}
