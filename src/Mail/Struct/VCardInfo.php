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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * VCardInfo class
 * Input for creating a new contact VCard
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class VCardInfo
{
    /**
     * Message ID.  Use in conjunction with part-identifier
     * @Accessor(getter="getMessageId", setter="setMessageId")
     * @SerializedName("mid")
     * @Type("string")
     * @XmlAttribute
     */
    private $messageId;

    /**
     * Part identifier.  Use in conjunction with message-id
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     */
    private $part;

    /**
     * Uploaded attachment ID
     * @Accessor(getter="getAttachId", setter="setAttachId")
     * @SerializedName("aid")
     * @Type("string")
     * @XmlAttribute
     */
    private $attachId;

    /**
     * inlined VCARD data
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue
     */
    private $value;

    /**
     * Constructor method for VCardInfo
     *
     * @param  string $messageId
     * @param  string $part
     * @param  string $attachId
     * @param  string $value
     * @return self
     */
    public function __construct(
        ?string $messageId = NULL,
        ?string $part = NULL,
        ?string $attachId = NULL,
        ?string $value = NULL
    )
    {
        if (NULL !== $messageId) {
            $this->setMessageId($messageId);
        }
        if (NULL !== $part) {
            $this->setPart($part);
        }
        if (NULL !== $attachId) {
            $this->setAttachId($attachId);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
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
     * Get attachId
     *
     * @return string
     */
    public function getAttachId(): ?string
    {
        return $this->attachId;
    }

    /**
     * Set attachId
     *
     * @param  string $attachId
     * @return self
     */
    public function setAttachId(string $attachId): self
    {
        $this->attachId = $attachId;
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

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
