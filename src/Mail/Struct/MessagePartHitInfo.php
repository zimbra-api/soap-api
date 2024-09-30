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
    XmlElement
};
use Zimbra\Common\Struct\SearchHit;

/**
 * MessagePartHitInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MessagePartHitInfo implements SearchHit
{
    /**
     * Message ID
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $id;

    /**
     * Sort field value
     *
     * @var string
     */
    #[Accessor(getter: "getSortField", setter: "setSortField")]
    #[SerializedName("sf")]
    #[Type("string")]
    #[XmlAttribute]
    private $sortField;

    /**
     * Size in bytes
     *
     * @var int
     */
    #[Accessor(getter: "getSize", setter: "setSize")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private $size;

    /**
     * Secs since epoch, from date header in message
     *
     * @var int
     */
    #[Accessor(getter: "getDate", setter: "setDate")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private $date;

    /**
     * Converstation id. only present if <m> is not enclosed within a <c> element
     *
     * @var int
     */
    #[Accessor(getter: "getConversationId", setter: "setConversationId")]
    #[SerializedName("cid")]
    #[Type("int")]
    #[XmlAttribute]
    private $conversationId;

    /**
     * Message item ID
     *
     * @var int
     */
    #[Accessor(getter: "getMessageId", setter: "setMessageId")]
    #[SerializedName("mid")]
    #[Type("int")]
    #[XmlAttribute]
    private $messageId;

    /**
     * Content type
     *
     * @var string
     */
    #[Accessor(getter: "getContentType", setter: "setContentType")]
    #[SerializedName("ct")]
    #[Type("string")]
    #[XmlAttribute]
    private $contentType;

    /**
     * File name
     *
     * @var string
     */
    #[Accessor(getter: "getContentName", setter: "setContentName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $contentName;

    /**
     * MIME part name
     *
     * @var string
     */
    #[Accessor(getter: "getPart", setter: "setPart")]
    #[SerializedName("part")]
    #[Type("string")]
    #[XmlAttribute]
    private $part;

    /**
     * Email address information
     *
     * @var EmailInfo
     */
    #[Accessor(getter: "getEmail", setter: "setEmail")]
    #[SerializedName("e")]
    #[Type(EmailInfo::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?EmailInfo $email;

    /**
     * Subject
     *
     * @var string
     */
    #[Accessor(getter: "getSubject", setter: "setSubject")]
    #[SerializedName("su")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $subject;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $sortField
     * @param  int $size
     * @param  int $date
     * @param  int $conversationId
     * @param  int $messageId
     * @param  string $contentType
     * @param  string $contentName
     * @param  string $part
     * @param  EmailInfo $email
     * @param  string $subject
     * @return self
     */
    public function __construct(
        ?string $id = null,
        ?string $sortField = null,
        ?int $size = null,
        ?int $date = null,
        ?int $conversationId = null,
        ?int $messageId = null,
        ?string $contentType = null,
        ?string $contentName = null,
        ?string $part = null,
        ?EmailInfo $email = null,
        ?string $subject = null
    ) {
        $this->email = $email;
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $sortField) {
            $this->setSortField($sortField);
        }
        if (null !== $size) {
            $this->setSize($size);
        }
        if (null !== $date) {
            $this->setDate($date);
        }
        if (null !== $conversationId) {
            $this->setConversationId($conversationId);
        }
        if (null !== $messageId) {
            $this->setMessageId($messageId);
        }
        if (null !== $contentType) {
            $this->setContentType($contentType);
        }
        if (null !== $contentName) {
            $this->setContentName($contentName);
        }
        if (null !== $part) {
            $this->setPart($part);
        }
        if (null !== $subject) {
            $this->setSubject($subject);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get sortField
     *
     * @return string
     */
    public function getSortField(): ?string
    {
        return $this->sortField;
    }

    /**
     * Set sortField
     *
     * @param  string $sortField
     * @return self
     */
    public function setSortField(string $sortField): self
    {
        $this->sortField = $sortField;
        return $this;
    }

    /**
     * Get size
     *
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set size
     *
     * @param  int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Get date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get conversationId
     *
     * @return int
     */
    public function getConversationId(): ?int
    {
        return $this->conversationId;
    }

    /**
     * Set conversationId
     *
     * @param  int $conversationId
     * @return self
     */
    public function setConversationId(int $conversationId): self
    {
        $this->conversationId = $conversationId;
        return $this;
    }

    /**
     * Get messageId
     *
     * @return int
     */
    public function getMessageId(): ?int
    {
        return $this->messageId;
    }

    /**
     * Set messageId
     *
     * @param  int $messageId
     * @return self
     */
    public function setMessageId(int $messageId): self
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * Get contentType
     *
     * @return string
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * Set contentType
     *
     * @param  string $contentType
     * @return self
     */
    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * Get contentName
     *
     * @return string
     */
    public function getContentName(): ?string
    {
        return $this->contentName;
    }

    /**
     * Set contentName
     *
     * @param  string $contentName
     * @return self
     */
    public function setContentName(string $contentName): self
    {
        $this->contentName = $contentName;
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
     * Get email
     *
     * @return EmailInfo
     */
    public function getEmail(): ?EmailInfo
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param  EmailInfo $email
     * @return self
     */
    public function setEmail(EmailInfo $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set subject
     *
     * @param  string $subject
     * @return self
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }
}
