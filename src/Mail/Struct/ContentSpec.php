<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
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
    XmlValue
};

/**
 * ContentSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContentSpec
{
    /**
     * Attachment upload ID of uploaded object to use
     *
     * @var string
     */
    #[Accessor(getter: "getAttachmentId", setter: "setAttachmentId")]
    #[SerializedName("aid")]
    #[Type("string")]
    #[XmlAttribute]
    private $attachmentId;

    /**
     * Message ID of existing message. Used in conjunction with "part"
     *
     * @var string
     */
    #[Accessor(getter: "getMessageId", setter: "setMessageId")]
    #[SerializedName("mid")]
    #[Type("string")]
    #[XmlAttribute]
    private $messageId;

    /**
     * Part identifier. This combined with "mid" identifies a part of an existing message
     *
     * @var string
     */
    #[Accessor(getter: "getPart", setter: "setPart")]
    #[SerializedName("part")]
    #[Type("string")]
    #[XmlAttribute]
    private $part;

    /**
     * Inlined content data. Ignored if "aid" or "mid"/"part" specified
     *
     * @var string
     */
    #[Accessor(getter: "getText", setter: "setText")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $text;

    /**
     * Constructor
     *
     * @param string $attachmentId
     * @param string $messageId
     * @param string $part
     * @param string $text
     * @return self
     */
    public function __construct(
        ?string $attachmentId = null,
        ?string $messageId = null,
        ?string $part = null,
        ?string $text = null
    ) {
        if (null !== $attachmentId) {
            $this->setAttachmentId($attachmentId);
        }
        if (null !== $messageId) {
            $this->setMessageId($messageId);
        }
        if (null !== $part) {
            $this->setPart($part);
        }
        if (null !== $text) {
            $this->setText($text);
        }
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param  string $text
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
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
     * Get messageId
     *
     * @return string
     */
    public function getMessageId(): ?string
    {
        return $this->messageId;
    }

    /**
     * Set messageId
     *
     * @param  string $messageId
     * @return self
     */
    public function setMessageId(string $messageId): self
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * Get part
     *
     * @return string
     */
    public function getPart(): ?string
    {
        return $this->part;
    }

    /**
     * Set part
     *
     * @param  string $part
     * @return self
     */
    public function setPart(string $part): self
    {
        $this->part = $part;
        return $this;
    }
}
