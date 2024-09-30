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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlList
};

/**
 * AttachmentsInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AttachmentsInfo
{
    /**
     * Attachment upload ID
     *
     * @var string
     */
    #[Accessor(getter: "getAttachmentId", setter: "setAttachmentId")]
    #[SerializedName("aid")]
    #[Type("string")]
    #[XmlAttribute]
    private $attachmentId;

    /**
     * Mime part attachment details
     *
     * @var array
     */
    #[Accessor(getter: "getMpAttachments", setter: "setMpAttachments")]
    #[Type("array<Zimbra\Mail\Struct\MimePartAttachSpec>")]
    #[XmlList(inline: true, entry: "mp", namespace: "urn:zimbraMail")]
    private $mpAttachments = [];

    /**
     * Msg attachment details
     *
     * @var array
     */
    #[Accessor(getter: "getMsgAttachments", setter: "setMsgAttachments")]
    #[Type("array<Zimbra\Mail\Struct\MsgAttachSpec>")]
    #[XmlList(inline: true, entry: "m", namespace: "urn:zimbraMail")]
    private $msgAttachments = [];

    /**
     * Contact attachment details
     *
     * @var array
     */
    #[
        Accessor(
            getter: "getContactAttachments",
            setter: "setContactAttachments"
        )
    ]
    #[Type("array<Zimbra\Mail\Struct\ContactAttachSpec>")]
    #[XmlList(inline: true, entry: "cn", namespace: "urn:zimbraMail")]
    private $cnAttachments = [];

    /**
     * Doc attachment details
     *
     * @var array
     */
    #[Accessor(getter: "getDocAttachments", setter: "setDocAttachments")]
    #[Type("array<Zimbra\Mail\Struct\DocAttachSpec>")]
    #[XmlList(inline: true, entry: "doc", namespace: "urn:zimbraMail")]
    private $docAttachments = [];

    /**
     * Constructor
     *
     * @param string $attachmentId
     * @param array $attachments
     * @return self
     */
    public function __construct(
        ?string $attachmentId = null,
        array $attachments = []
    ) {
        $this->setAttachments($attachments);
        if (null !== $attachmentId) {
            $this->setAttachmentId($attachmentId);
        }
    }

    /**
     * Get attachmentId
     *
     * @return string
     */
    public function getAttachmentId(): ?string
    {
        return $this->attachmentId;
    }

    /**
     * Set attachmentId
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
     * Set attachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setAttachments(array $attachments): self
    {
        return $this->setMpAttachments($attachments)
            ->setMsgAttachments($attachments)
            ->setContactAttachments($attachments)
            ->setDocAttachments($attachments);
    }

    /**
     * Get attachments
     *
     * @return array
     */
    public function getAttachments(): array
    {
        return array_merge(
            $this->mpAttachments,
            $this->msgAttachments,
            $this->cnAttachments,
            $this->docAttachments
        );
    }

    /**
     * Set mpAttachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setMpAttachments(array $attachments): self
    {
        $this->mpAttachments = array_values(
            array_filter(
                $attachments,
                static fn($attachment) => $attachment instanceof
                    MimePartAttachSpec
            )
        );
        return $this;
    }

    /**
     * Get mpAttachments
     *
     * @return array
     */
    public function getMpAttachments(): array
    {
        return $this->mpAttachments;
    }

    /**
     * Set msgAttachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setMsgAttachments(array $attachments): self
    {
        $this->msgAttachments = array_values(
            array_filter(
                $attachments,
                static fn($attachment) => $attachment instanceof MsgAttachSpec
            )
        );
        return $this;
    }

    /**
     * Get msgAttachments
     *
     * @return array
     */
    public function getMsgAttachments(): array
    {
        return $this->msgAttachments;
    }

    /**
     * Set cnAttachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setContactAttachments(array $attachments): self
    {
        $this->cnAttachments = array_values(
            array_filter(
                $attachments,
                static fn($attachment) => $attachment instanceof
                    ContactAttachSpec
            )
        );
        return $this;
    }

    /**
     * Get cnAttachments
     *
     * @return array
     */
    public function getContactAttachments(): array
    {
        return $this->cnAttachments;
    }

    /**
     * Set docAttachments
     *
     * @param  array $attachments
     * @return self
     */
    public function setDocAttachments(array $attachments): self
    {
        $this->docAttachments = array_values(
            array_filter(
                $attachments,
                static fn($attachment) => $attachment instanceof DocAttachSpec
            )
        );
        return $this;
    }

    /**
     * Get docAttachments
     *
     * @return array
     */
    public function getDocAttachments(): array
    {
        return $this->docAttachments;
    }
}
