<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};

/**
 * AttachmentsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="attach")
 */
class AttachmentsInfo
{
    /**
     * Attachment upload ID
     * @Accessor(getter="getAttachmentId", setter="setAttachmentId")
     * @SerializedName("aid")
     * @Type("string")
     * @XmlAttribute
     */
    private $attachmentId;

    /**
     * Mime part attachment details
     * @Accessor(getter="getMpAttachments", setter="setMpAttachments")
     * @SerializedName("mp")
     * @Type("array<Zimbra\Mail\Struct\MimePartAttachSpec>")
     * @XmlList(inline = true, entry = "mp")
     */
    private $mpAttachments;

    /**
     * Msg attachment details
     * @Accessor(getter="getMsgAttachments", setter="setMsgAttachments")
     * @SerializedName("m")
     * @Type("array<Zimbra\Mail\Struct\MsgAttachSpec>")
     * @XmlList(inline = true, entry = "m")
     */
    private $msgAttachments;

    /**
     * Contact attachment details
     * @Accessor(getter="getContactAttachments", setter="setContactAttachments")
     * @SerializedName("cn")
     * @Type("array<Zimbra\Mail\Struct\ContactAttachSpec>")
     * @XmlList(inline = true, entry = "cn")
     */
    private $cnAttachments;

    /**
     * Doc attachment details
     * @Accessor(getter="getDocAttachments", setter="setDocAttachments")
     * @SerializedName("doc")
     * @Type("array<Zimbra\Mail\Struct\DocAttachSpec>")
     * @XmlList(inline = true, entry = "doc")
     */
    private $docAttachments;

    /**
     * Constructor method for policy
     * @param string $attachmentId
     * @param array $attachments
     * @return self
     */
    public function __construct(?string $attachmentId = NULL, array $attachments = [])
    {
        $this->setAttachments($attachments);
        if (NULL !== $attachmentId) {
            $this->setAttachmentId($attachmentId);
        }
    }

    /**
     * Gets attachmentId
     *
     * @return string
     */
    public function getAttachmentId(): ?string
    {
        return $this->attachmentId;
    }

    /**
     * Sets attachmentId
     *
     * @param  string $attachmentId
     * @return self
     */
    public function setAttachmentId(string $attachmentId): self
    {
        $this->attachmentId = $attachmentId;
        return $this;
    }

    /**
     * Add attachment
     *
     * @param  AttachSpec $attachment
     * @return self
     */
    public function addAttachment(AttachSpec $attachment): self
    {
        if ($attachment instanceof MimePartAttachSpec) {
            $this->mpAttachments[] = $attachment;
        }
        if ($attachment instanceof MsgAttachSpec) {
            $this->msgAttachments[] = $attachment;
        }
        if ($attachment instanceof ContactAttachSpec) {
            $this->cnAttachments[] = $attachment;
        }
        if ($attachment instanceof DocAttachSpec) {
            $this->docAttachments[] = $attachment;
        }
        return $this;
    }

    /**
     * Sets attachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setAttachments(array $attachments): self
    {
        $this->mpAttachments = $this->msgAttachments = $this->cnAttachments = $this->docAttachments = [];
        foreach ($attachments as $attachment) {
            if ($attachment instanceof AttachSpec) {
                $this->addAttachment($attachment);
            }
        }
        return $this;
    }

    /**
     * Gets attachments
     *
     * @return array
     */
    public function getAttachments(): array
    {
        return array_merge($this->mpAttachments, $this->msgAttachments, $this->cnAttachments, $this->docAttachments);
    }

    /**
     * Sets mpAttachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setMpAttachments(array $attachments): self
    {
        $this->mpAttachments = [];
        foreach ($attachments as $attachment) {
            if ($attachment instanceof MimePartAttachSpec) {
                $this->mpAttachments[] = $attachment;
            }
        }
        return $this;
    }

    /**
     * Gets mpAttachments
     *
     * @return array
     */
    public function getMpAttachments(): array
    {
        return $this->mpAttachments;
    }

    /**
     * Sets msgAttachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setMsgAttachments(array $attachments): self
    {
        $this->msgAttachments = [];
        foreach ($attachments as $attachment) {
            if ($attachment instanceof MsgAttachSpec) {
                $this->msgAttachments[] = $attachment;
            }
        }
        return $this;
    }

    /**
     * Gets msgAttachments
     *
     * @return array
     */
    public function getMsgAttachments(): array
    {
        return $this->msgAttachments;
    }

    /**
     * Sets cnAttachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setContactAttachments(array $attachments): self
    {
        $this->cnAttachments = [];
        foreach ($attachments as $attachment) {
            if ($attachment instanceof ContactAttachSpec) {
                $this->cnAttachments[] = $attachment;
            }
        }
        return $this;
    }

    /**
     * Gets cnAttachments
     *
     * @return array
     */
    public function getContactAttachments(): array
    {
        return $this->cnAttachments;
    }

    /**
     * Sets docAttachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setDocAttachments(array $attachments): self
    {
        $this->docAttachments = [];
        foreach ($attachments as $attachment) {
            if ($attachment instanceof DocAttachSpec) {
                $this->docAttachments[] = $attachment;
            }
        }
        return $this;
    }

    /**
     * Gets docAttachments
     *
     * @return array
     */
    public function getDocAttachments(): array
    {
        return $this->docAttachments;
    }
}
