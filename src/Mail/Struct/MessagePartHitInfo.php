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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
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
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Sort field value
     * 
     * @Accessor(getter="getSortField", setter="setSortField")
     * @SerializedName("sf")
     * @Type("string")
     * @XmlAttribute
     */
    private $sortField;

    /**
     * Size in bytes
     * 
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $size;

    /**
     * Secs since epoch, from date header in message
     * 
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("integer")
     * @XmlAttribute
     */
    private $date;

    /**
     * Converstation id. only present if <m> is not enclosed within a <c> element
     * 
     * @Accessor(getter="getConversationId", setter="setConversationId")
     * @SerializedName("cid")
     * @Type("integer")
     * @XmlAttribute
     */
    private $conversationId;

    /**
     * Message item ID
     * 
     * @Accessor(getter="getMessageId", setter="setMessageId")
     * @SerializedName("mid")
     * @Type("integer")
     * @XmlAttribute
     */
    private $messageId;

    /**
     * Content type
     * 
     * @Accessor(getter="getContentType", setter="setContentType")
     * @SerializedName("ct")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentType;

    /**
     * Filename
     * 
     * @Accessor(getter="getContentName", setter="setContentName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $contentName;

    /**
     * MIME part name
     * 
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     */
    private $part;

    /**
     * Email address information
     * 
     * @Accessor(getter="getEmail", setter="setEmail")
     * @SerializedName("e")
     * @Type("Zimbra\Mail\Struct\EmailInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?EmailInfo $email = NULL;

    /**
     * Subject
     * 
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     */
    private $subject;

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $sortField = NULL,
        ?int $size = NULL,
        ?int $date = NULL,
        ?int $conversationId = NULL,
        ?int $messageId = NULL,
        ?string $contentType = NULL,
        ?string $contentName = NULL,
        ?string $part = NULL,
        ?EmailInfo $email = NULL,
        ?string $subject = NULL
    )
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $sortField) {
            $this->setSortField($sortField);
        }
        if (NULL !== $size) {
            $this->setSize($size);
        }
        if (NULL !== $date) {
            $this->setDate($date);
        }
        if (NULL !== $conversationId) {
            $this->setConversationId($conversationId);
        }
        if (NULL !== $messageId) {
            $this->setMessageId($messageId);
        }
        if (NULL !== $contentType) {
            $this->setContentType($contentType);
        }
        if (NULL !== $contentName) {
            $this->setContentName($contentName);
        }
        if (NULL !== $part) {
            $this->setPart($part);
        }
        if ($email instanceof EmailInfo) {
            $this->setEmail($email);
        }
        if (NULL !== $subject) {
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
     * @return string
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
