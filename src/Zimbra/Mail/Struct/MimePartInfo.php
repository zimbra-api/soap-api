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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * MimePartInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class MimePartInfo extends Base
{
    /**
     * MIME Parts 
     * @var TypedSequence
     */
    private $_mimeParts;

    /**
     * Constructor method for MimePartInfo
     * @param  AttachmentsInfo $attach Attachments
     * @param  string $ct Content type.
     * @param  string $content Content.
     * @param  string $ci Content ID.
     * @param  array $mps MIME Parts 
     * @return self
     */
    public function __construct(
        AttachmentsInfo $attach = null,
        $ct = null,
        $content = null,
        $ci = null,
        array $mimeParts = []
    )
    {
        parent::__construct();
        if($attach instanceof AttachmentsInfo)
        {
            $this->setChild('attach', $attach);
        }
        if(null !== $ct)
        {
            $this->setProperty('ct', trim($ct));
        }
        if(null !== $content)
        {
            $this->setProperty('content', trim($content));
        }
        if(null !== $ci)
        {
            $this->setProperty('ci', trim($ci));
        }

        $this->setMimeParts($mimeParts);
        $this->on('before', function(Base $sender)
        {
            if($sender->getMimeParts()->count())
            {
                $sender->setChild('mp', $sender->getMimeParts()->all());
            }
        });
    }

    /**
     * Add a mime part info
     *
     * @param  MimePartInfo $mp
     * @return self
     */
    public function addMimePart(MimePartInfo $mp)
    {
        $this->_mimeParts->add($mp);
        return $this;
    }

    /**
     * Sets mime part sequence
     *
     * @param  array $mimeParts
     * @return self
     */
    public function setMimeParts(array $mimeParts)
    {
        $this->_mimeParts = new TypedSequence('Zimbra\Mail\Struct\MimePartInfo', $mimeParts);
        return $this;
    }

    /**
     * Gets mime part sequence
     *
     * @return Sequence
     */
    public function getMimeParts()
    {
        return $this->_mimeParts;
    }

    /**
     * Gets attachments
     *
     * @return AttachmentsInfo
     */
    public function getAttachments()
    {
        return $this->getChild('attach');
    }

    /**
     * Sets attachments
     *
     * @param  AttachmentsInfo $attach
     * @return self
     */
    public function setAttachments(AttachmentsInfo $attach)
    {
        return $this->setChild('attach', $attach);
    }

    /**
     * Gets content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->getProperty('ct');
    }

    /**
     * Sets content type
     *
     * @param  string $ct
     * @return self
     */
    public function setContentType($ct)
    {
        return $this->setProperty('ct', trim($ct));
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->getProperty('content');
    }

    /**
     * Sets content
     *
     * @param  string $content
     * @return self
     */
    public function setContent($content)
    {
        return $this->setProperty('content', trim($content));
    }

    /**
     * Gets content id
     *
     * @return string
     */
    public function getContentId()
    {
        return $this->getProperty('ci');
    }

    /**
     * Sets content id
     *
     * @param  string $ci
     * @return self
     */
    public function setContentId($ci)
    {
        return $this->setProperty('ci', trim($ci));
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
