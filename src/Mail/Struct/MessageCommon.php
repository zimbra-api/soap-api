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
use Zimbra\Common\Struct\{CustomMetadataInterface, MessageCommonInterface};

/**
 * MessageCommon struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MessageCommon implements MessageCommonInterface
{
    /**
     * Size in bytes
     *
     * @var int
     */
    #[Accessor(getter: "getSize", setter: "setSize")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $size = null;

    /**
     * Date Seconds since the epoch, from the date header in the message
     *
     * @var int
     */
    #[Accessor(getter: "getDate", setter: "setDate")]
    #[SerializedName("d")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $date = null;

    /**
     * Folder ID
     *
     * @var string
     */
    #[Accessor(getter: "getFolder", setter: "setFolder")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $folder = null;

    /**
     * Converstation ID
     *
     * @var string
     */
    #[Accessor(getter: "getConversationId", setter: "setConversationId")]
    #[SerializedName("cid")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $conversationId = null;

    /**
     * Flags.  (u)nread, (f)lagged, has (a)ttachment, (r)eplied, (s)ent by me,
     * for(w)arded, calendar in(v)ite, (d)raft, IMAP-\Deleted (x), (n)otification sent, urgent (!),
     * low-priority (?), priority (+)
     *
     * @var string
     */
    #[Accessor(getter: "getFlags", setter: "setFlags")]
    #[SerializedName("f")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $flags = null;

    /**
     * Tags - Comma separated list of ints.  DEPRECATED - use "tn" instead
     *
     * @var string
     */
    #[Accessor(getter: "getTags", setter: "setTags")]
    #[SerializedName("t")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $tags = null;

    /**
     * Comma separated list of tag names
     *
     * @var string
     */
    #[Accessor(getter: "getTagNames", setter: "setTagNames")]
    #[SerializedName("tn")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $tagNames = null;

    /**
     * Revision
     *
     * @var int
     */
    #[Accessor(getter: "getRevision", setter: "setRevision")]
    #[SerializedName("rev")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $revision = null;

    /**
     * Date metadata changed
     *
     * @var int
     */
    #[Accessor(getter: "getChangeDate", setter: "setChangeDate")]
    #[SerializedName("md")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $changeDate = null;

    /**
     * Change sequence
     *
     * @var int
     */
    #[Accessor(getter: "getModifiedSequence", setter: "setModifiedSequence")]
    #[SerializedName("ms")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $modifiedSequence = null;

    /**
     * Custom metadata information
     *
     * @var array
     */
    #[Accessor(getter: "getMetadatas", setter: "setMetadatas")]
    #[Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")]
    #[XmlList(inline: true, entry: "meta", namespace: "urn:zimbraMail")]
    private array $metadatas = [];

    /**
     * Constructor
     *
     * @param int $size
     * @param int $date
     * @param string $folder
     * @param string $conversationId
     * @param string $flags
     * @param string $tags
     * @param string $tagNames
     * @param int $revision
     * @param int $changeDate
     * @param int $modifiedSequence
     * @param array $metadatas
     * @return self
     */
    public function __construct(
        ?int $size = null,
        ?int $date = null,
        ?string $folder = null,
        ?string $conversationId = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?int $revision = null,
        ?int $changeDate = null,
        ?int $modifiedSequence = null,
        array $metadatas = []
    ) {
        $this->setMetadatas($metadatas);
        if (null !== $size) {
            $this->setSize($size);
        }
        if (null !== $date) {
            $this->setDate($date);
        }
        if (null !== $folder) {
            $this->setFolder($folder);
        }
        if (null !== $conversationId) {
            $this->setConversationId($conversationId);
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
        if (null !== $revision) {
            $this->setRevision($revision);
        }
        if (null !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (null !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
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
     * Get folder
     *
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * Set folder
     *
     * @param  string $folder
     * @return self
     */
    public function setFolder(string $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Get conversationId
     *
     * @return string
     */
    public function getConversationId(): ?string
    {
        return $this->conversationId;
    }

    /**
     * Set conversationId
     *
     * @param  string $conversationId
     * @return self
     */
    public function setConversationId(string $conversationId): self
    {
        $this->conversationId = $conversationId;
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
     * Get revision
     *
     * @return int
     */
    public function getRevision(): ?int
    {
        return $this->revision;
    }

    /**
     * Set revision
     *
     * @param  int $revision
     * @return self
     */
    public function setRevision(int $revision): self
    {
        $this->revision = $revision;
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
     * Set metadatas
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        $this->metadatas = array_filter(
            $metadatas,
            static fn($metadata) => $metadata instanceof CustomMetadataInterface
        );
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
}
