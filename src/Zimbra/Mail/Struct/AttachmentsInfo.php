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
 * AttachmentsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AttachmentsInfo extends Base
{
    /**
     * Attachment details
     * @var TypedSequence<AttachSpec>
     */
    private $_attachments;

    /**
     * Constructor method for AttachmentsInfo
     * @param  string $aid Attachment upload ID
     * @param  MimePartAttachSpec $mp MimePart Attach Spec
     * @param  MsgAttachSpec $m Msg Attach Spec
     * @param  ContactAttachSpec $cn Contact Attach Spec
     * @param  DocAttachSpec $doc Doc Attach Spec
     * @return self
     */
    public function __construct($aid = null, array $attachments = [])
    {
        parent::__construct();
        parent::__construct();
        $this->setProperty('aid', trim($aid));
        $this->setAttachments($attachments);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAttachments()->count())
            {
                foreach ($sender->getAttachments()->all() as $attachment)
                {
                    if($attachment instanceof MimePartAttachSpec)
                    {
                        $this->setChild('mp', $attachment);
                    }
                    if($attachment instanceof MsgAttachSpec)
                    {
                        $this->setChild('m', $attachment);
                    }
                    if($attachment instanceof ContactAttachSpec)
                    {
                        $this->setChild('cn', $attachment);
                    }
                    if($attachment instanceof DocAttachSpec)
                    {
                        $this->setChild('doc', $attachment);
                    }
                }
            }
        });
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
     * Add a attachment
     *
     * @param  AttachSpec $attr
     * @return self
     */
    public function addAttachment(AttachSpec $attachment)
    {
        $this->_attachments->add($attachment);
        return $this;
    }

    /**
     * Sets attachment sequence
     *
     * @param  array $attachments
     * @return self
     */
    public function setAttachments(array $attachments)
    {
        $this->_attachments = new TypedSequence('Zimbra\Mail\Struct\AttachSpec', $attachments);
        return $this;
    }

    /**
     * Gets attachment sequence
     *
     * @return Sequence
     */
    public function getAttachments()
    {
        return $this->_attachments;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'attach')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'attach')
    {
        return parent::toXml($name);
    }
}
