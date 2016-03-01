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
 * AddMsgSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddMsgSpec extends Base
{
    /**
     * Constructor method for AddMsgSpec
     * @param string $content The entire message's content. (Omit if you specify an "aid" attribute.)
     * @param string $flags Flags - (u)nread, (f)lagged, has (a)ttachment, (r)eplied, (s)ent by me, for(w)arded, (d)raft, deleted (x), (n)otification sent
     * @param string $tags Tags - Comma separated list of integers. DEPRECATED - use "tn" instead
     * @param string $tagNames Comma-separated list of tag names
     * @param string $folder Folder pathname (starts with '/') or folder ID
     * @param bool   $noICal If set, then don't process iCal attachments. Default is unset.
     * @param int $dateReceived Time the message was originally received, in MILLISECONDS since the epoch
     * @param string $attachmentId Uploaded MIME body ID - ID of message uploaded via FileUploadServlet
     * @return self
     */
    public function __construct(
        $content = null,
        $flags = null,
        $tags = null,
        $tagNames = null,
        $folder = null,
        $noICal = null,
        $dateReceived = null,
        $attachmentId = null
    )
    {
        parent::__construct();
        if(null !== $content)
        {
            $this->setChild('content', trim($content));
        }
        if(null !== $flags)
        {
            $this->setProperty('f', trim($flags));
        }
        if(null !== $tags)
        {
            $this->setProperty('t', trim($tags));
        }
        if(null !== $tagNames)
        {
            $this->setProperty('tn', trim($tagNames));
        }
        if(null !== $folder)
        {
            $this->setProperty('l', trim($folder));
        }
        if(null !== $noICal)
        {
            $this->setProperty('noICal', (bool) $noICal);
        }
        if(null !== $dateReceived)
        {
            $this->setProperty('d', (int) $dateReceived);
        }
        if(null !== $attachmentId)
        {
            $this->setProperty('aid', trim($attachmentId));
        }
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getChild('content');
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent($content)
    {
        return $this->setChild('content', trim($content));
    }

    /**
     * Gets flags
     *
     * @return string
     */
    public function getFlags()
    {
        return $this->getProperty('f');
    }

    /**
     * Sets flags
     *
     * @param  string $flags
     * @return string|self
     */
    public function setFlags($flags)
    {
        return $this->setProperty('f', trim($flags));
    }

    /**
     * Gets tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->getProperty('t');
    }

    /**
     * Sets tags
     *
     * @param  string $tags
     * @return string|self
     */
    public function setTags($tags)
    {
        return $this->setProperty('t', trim($tags));
    }

    /**
     * Gets tag names
     *
     * @return string
     */
    public function getTagNames()
    {
        return $this->getProperty('tn');
    }

    /**
     * Sets tag names
     *
     * @param  string $tagNames
     * @return string|self
     */
    public function setTagNames($tagNames)
    {
        return $this->setProperty('tn', trim($tagNames));
    }

    /**
     * Gets folder
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->getProperty('l');
    }

    /**
     * Sets folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder($folder)
    {
        return $this->setProperty('l', trim($folder));
    }

    /**
     * Gets noICal flag
     *
     * @return bool
     */
    public function getNoICal()
    {
        return $this->getProperty('noICal');
    }

    /**
     * Sets noICal flag
     *
     * @param  bool $noICal
     * @return self
     */
    public function setNoICal($noICal)
    {
        return $this->setProperty('noICal', (bool) $noICal);
    }

    /**
     * Gets time received
     *
     * @return int
     */
    public function getDateReceived()
    {
        return $this->getProperty('d');
    }

    /**
     * Sets time received
     *
     * @param  int $dateReceived
     * @return self
     */
    public function setDateReceived($dateReceived)
    {
        return $this->setProperty('d', (int) $dateReceived);
    }

    /**
     * Gets attachment id
     *
     * @return string
     */
    public function getAttachmentId()
    {
        return $this->getProperty('aid');
    }

    /**
     * Sets attachment id
     *
     * @param  string $attachmentId
     * @return self
     */
    public function setAttachmentId($attachmentId)
    {
        return $this->setProperty('aid', trim($attachmentId));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        return parent::toXml($name);
    }
}
