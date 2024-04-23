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
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * Number of messages in conversation without IMAP \Deleted flag set
     * 
     * @var int
     */
    #[Accessor(getter: 'getNum', setter: 'setNum')]
    #[SerializedName('n')]
    #[Type('int')]
    #[XmlAttribute]
    private $num;

    /**
     * Number of unread messages in conversation
     * 
     * @var int
     */
    #[Accessor(getter: 'getNumUnread', setter: 'setNumUnread')]
    #[SerializedName('u')]
    #[Type('int')]
    #[XmlAttribute]
    private $numUnread;

    /**
     * Total number of messages in conversation including those with the IMAP \Deleted flag set
     * 
     * @var int
     */
    #[Accessor(getter: 'getTotalSize', setter: 'setTotalSize')]
    #[SerializedName('total')]
    #[Type('int')]
    #[XmlAttribute]
    private $totalSize;

    /**
     * Same flags as on <m> ("sarwfdxnu!?"), aggregated from all the conversation's messages
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName('f')]
    #[Type('string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     * 
     * @var string
     */
    #[Accessor(getter: 'getTags', setter: 'setTags')]
    #[SerializedName('t')]
    #[Type('string')]
    #[XmlAttribute]
    private $tags;

    /**
     * Comma-separated list of tag names
     * 
     * @var string
     */
    #[Accessor(getter: 'getTagNames', setter: 'setTagNames')]
    #[SerializedName('tn')]
    #[Type('string')]
    #[XmlAttribute]
    private $tagNames;

    /**
     * Date (secs since epoch) of most recent message in the converstation
     * 
     * @var int
     */
    #[Accessor(getter: 'getDate', setter: 'setDate')]
    #[SerializedName('d')]
    #[Type('int')]
    #[XmlAttribute]
    private $date;

    /**
     * If elided is set, some participants are missing before the first returned <e> element
     * 
     * @var bool
     */
    #[Accessor(getter: 'getElided', setter: 'setElided')]
    #[SerializedName('elided')]
    #[Type('bool')]
    #[XmlAttribute]
    private $elided;

    /**
     * Modified date in seconds
     * 
     * @var int
     */
    #[Accessor(getter: 'getChangeDate', setter: 'setChangeDate')]
    #[SerializedName('md')]
    #[Type('int')]
    #[XmlAttribute]
    private $changeDate;

    /**
     * Modified sequence
     * 
     * @var int
     */
    #[Accessor(getter: 'getModifiedSequence', setter: 'setModifiedSequence')]
    #[SerializedName('ms')]
    #[Type('int')]
    #[XmlAttribute]
    private $modifiedSequence;

    /**
     * Custom metadata
     * 
     * @var array
     */
    #[Accessor(getter: 'getMetadatas', setter: 'setMetadatas')]
    #[Type('array<Zimbra\Mail\Struct\MailCustomMetadata>')]
    #[XmlList(inline: true, entry: 'meta', namespace: 'urn:zimbraMail')]
    private $metadatas = [];

    /**
     * Subject of conversation
     * 
     * @var string
     */
    #[Accessor(getter: 'getSubject', setter: 'setSubject')]
    #[SerializedName('su')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $subject;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * 
     * @var string
     */
    #[Accessor(getter: 'getFragment', setter: 'setFragment')]
    #[SerializedName('fr')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $fragment;

    /**
     * Email addresses
     * 
     * @var array
     */
    #[Accessor(getter: 'getEmails', setter: 'setEmails')]
    #[Type('array<Zimbra\Mail\Struct\EmailInfo>')]
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
        ?string $id = null,
        ?int $num = null,
        ?int $numUnread = null,
        ?int $totalSize = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?int $date = null,
        ?bool $elided = null,
        ?int $changeDate = null,
        ?int $modifiedSequence = null,
        array $metadatas = [],
        ?string $subject = null,
        ?string $fragment = null,
        array $emails = []
    )
    {
        $this->setMetadatas($metadatas)
             ->setEmails($emails);
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $num) {
            $this->setNum($num);
        }
        if (null !== $numUnread) {
            $this->setNumUnread($numUnread);
        }
        if (null !== $totalSize) {
            $this->setTotalSize($totalSize);
        }
        if (null !== $flags) {
            $this->setFlags($flags);
        }
        if (null !== $tags) {
            $this->setTags($tags);
        }
        if (null !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (null !== $date) {
            $this->setDate($date);
        }
        if (null !== $elided) {
            $this->setElided($elided);
        }
        if (null !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (null !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (null !== $subject) {
            $this->setSubject($subject);
        }
        if (null !== $fragment) {
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
        $this->metadatas = array_filter(
            $metadatas, static fn($metadata) => $metadata instanceof MailCustomMetadata
        );
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
        $this->emails = array_filter(
            $emails, static fn($email) => $email instanceof EmailInfo
        );
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
