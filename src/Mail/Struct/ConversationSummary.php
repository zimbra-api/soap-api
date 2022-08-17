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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * ConversationSummary struct class
 * Conversation search result information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConversationSummary
{
    /**
     * Conversation ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Number of messages in conversation without IMAP \Deleted flag set
     * 
     * @var int
     */
    #[Accessor(getter: 'getNum', setter: 'setNum')]
    #[SerializedName(name: 'n')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $num;

    /**
     * Number of unread messages in conversation
     * 
     * @var int
     */
    #[Accessor(getter: 'getNumUnread', setter: 'setNumUnread')]
    #[SerializedName(name: 'u')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $numUnread;

    /**
     * Total number of messages in conversation including those with the IMAP \Deleted flag set
     * 
     * @var int
     */
    #[Accessor(getter: 'getTotalSize', setter: 'setTotalSize')]
    #[SerializedName(name: 'total')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $totalSize;

    /**
     * Same flags as on <m> ("sarwfdxnu!?"), aggregated from all the conversation's messages
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName(name: 'f')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     * 
     * @var string
     */
    #[Accessor(getter: 'getTags', setter: 'setTags')]
    #[SerializedName(name: 't')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma-separated list of tag names
     * 
     * @var string
     */
    #[Accessor(getter: 'getTagNames', setter: 'setTagNames')]
    #[SerializedName(name: 'tn')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $tagNames;

    /**
     * Date (secs since epoch) of most recent message in the converstation
     * 
     * @var int
     */
    #[Accessor(getter: 'getDate', setter: 'setDate')]
    #[SerializedName(name: 'd')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $date;

    /**
     * If elided is set, some participants are missing before the first returned <e> element
     * 
     * @var bool
     */
    #[Accessor(getter: 'getElided', setter: 'setElided')]
    #[SerializedName(name: 'elided')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $elided;

    /**
     * Modified date in seconds
     * 
     * @var int
     */
    #[Accessor(getter: 'getChangeDate', setter: 'setChangeDate')]
    #[SerializedName(name: 'md')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $changeDate;

    /**
     * Modified sequence
     * 
     * @var int
     */
    #[Accessor(getter: 'getModifiedSequence', setter: 'setModifiedSequence')]
    #[SerializedName(name: 'ms')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $modifiedSequence;

    /**
     * Custom metadata
     * 
     * @var array
     */
    #[Accessor(getter: 'getMetadatas', setter: 'setMetadatas')]
    #[Type(name: 'array<Zimbra\Mail\Struct\MailCustomMetadata>')]
    #[XmlList(inline: true, entry: 'meta', namespace: 'urn:zimbraMail')]
    private $metadatas = [];

    /**
     * Subject of conversation
     * 
     * @var string
     */
    #[Accessor(getter: "getSubject", setter: "setSubject")]
    #[SerializedName(name: 'su')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $subject;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * 
     * @var string
     */
    #[Accessor(getter: "getFragment", setter: "setFragment")]
    #[SerializedName(name: 'fr')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $fragment;

    /**
     * Email addresses
     * 
     * @var array
     */
    #[Accessor(getter: 'getEmails', setter: 'setEmails')]
    #[Type(name: 'array<Zimbra\Mail\Struct\EmailInfo>')]
    #[XmlList(inline: true, entry: 'e', namespace: 'urn:zimbraMail')]
    private $emails = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  int $num
     * @param  int $numUnread
     * @param  int $totalSize
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  int $date
     * @param  bool $elided
     * @param  int $changeDate
     * @param  int $modifiedSequence
     * @param  array $metadatas
     * @param  string $subject
     * @param  string $fragment
     * @param  array $emails
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?int $num = NULL,
        ?int $numUnread = NULL,
        ?int $totalSize = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?int $date = NULL,
        ?bool $elided = NULL,
        ?int $changeDate = NULL,
        ?int $modifiedSequence = NULL,
        array $metadatas = [],
        ?string $subject = NULL,
        ?string $fragment = NULL,
        array $emails = []
    )
    {
        $this->setMetadatas($metadatas)
             ->setEmails($emails);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $num) {
            $this->setNum($num);
        }
        if (NULL !== $numUnread) {
            $this->setNumUnread($numUnread);
        }
        if (NULL !== $totalSize) {
            $this->setTotalSize($totalSize);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $tags) {
            $this->setTags($tags);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (NULL !== $date) {
            $this->setDate($date);
        }
        if (NULL !== $elided) {
            $this->setElided($elided);
        }
        if (NULL !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (NULL !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (NULL !== $subject) {
            $this->setSubject($subject);
        }
        if (NULL !== $fragment) {
            $this->setFragment($fragment);
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
     * Get num
     *
     * @return int
     */
    public function getNum(): ?int
    {
        return $this->num;
    }

    /**
     * Set num
     *
     * @param  int $num
     * @return self
     */
    public function setNum(int $num): self
    {
        $this->num = $num;
        return $this;
    }

    /**
     * Get numUnread
     *
     * @return int
     */
    public function getNumUnread(): ?int
    {
        return $this->numUnread;
    }

    /**
     * Set numUnread
     *
     * @param  int $numUnread
     * @return self
     */
    public function setNumUnread(int $numUnread): self
    {
        $this->numUnread = $numUnread;
        return $this;
    }

    /**
     * Get totalSize
     *
     * @return int
     */
    public function getTotalSize(): ?int
    {
        return $this->totalSize;
    }

    /**
     * Set totalSize
     *
     * @param  int $totalSize
     * @return self
     */
    public function setTotalSize(int $totalSize): self
    {
        $this->totalSize = $totalSize;
        return $this;
    }

    /**
     * Get flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Set flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags(string $flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Set tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Set tagNames
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames(string $tagNames): self
    {
        $this->tagNames = $tagNames;
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
     * Get elided
     *
     * @return bool
     */
    public function getElided(): ?bool
    {
        return $this->elided;
    }

    /**
     * Set elided
     *
     * @param  bool $elided
     * @return self
     */
    public function setElided(bool $elided): self
    {
        $this->elided = $elided;
        return $this;
    }

    /**
     * Get changeDate
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Set changeDate
     *
     * @param  int $changeDate
     * @return self
     */
    public function setChangeDate(int $changeDate): self
    {
        $this->changeDate = $changeDate;
        return $this;
    }

    /**
     * Get modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Set modifiedSequence
     *
     * @param  int $modifiedSequence
     * @return self
     */
    public function setModifiedSequence(int $modifiedSequence): self
    {
        $this->modifiedSequence = $modifiedSequence;
        return $this;
    }

    /**
     * Get metadatas
     *
     * @return array
     */
    public function getMetadatas(): array
    {
        return $this->metadatas;
    }

    /**
     * Set metadatas
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        $this->metadatas = array_filter($metadatas, static fn($metadata) => $metadata instanceof MailCustomMetadata);
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

    /**
     * Get fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Set fragment
     *
     * @param  string $fragment
     * @return self
     */
    public function setFragment(string $fragment): self
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * Set emails
     *
     * @param  array $emails
     * @return self
     */
    public function setEmails(array $emails): self
    {
        $this->emails = array_filter($emails, static fn($email) => $email instanceof EmailInfo);
        return $this;
    }

    /**
     * Get emails
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }
}
