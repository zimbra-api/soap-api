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
 * NestedSearchConversation class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NestedSearchConversation
{
    /**
     * Conversation ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Number of messages in conversation without IMAP \Deleted flag set
     * 
     * @Accessor(getter="getNum", setter="setNum")
     * @SerializedName("n")
     * @Type("integer")
     * @XmlAttribute
     */
    private $num;

    /**
     * Total number of messages in conversation
     * 
     * @Accessor(getter="getTotalSize", setter="setTotalSize")
     * @SerializedName("total")
     * @Type("integer")
     * @XmlAttribute
     */
    private $totalSize;

    /**
     * Same flags as on <m> ("sarwfdxnu!?"), aggregated from all the conversation's messages
     * 
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     */
    private $flags;

    /**
     * Tags - Comma separated list of integers.  DEPRECATED - use "tn" instead
     * 
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $tags;

    /**
     * Comma-separated list of tag names
     * 
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     */
    private $tagNames;

    /**
     * Message search hits
     * 
     * @Accessor(getter="getMessages", setter="setMessages")
     * @Type("array<Zimbra\Mail\Struct\MessageHitInfo>")
     * @XmlList(inline=true, entry="m", namespace="urn:zimbraMail")
     */
    private $messages = [];

    /**
     * Info block.  Used to return general status information about your search.
     * The <wildcard> element tells you about the status of wildcard expansions within your search.
     * If expanded is set, then the wildcard was expanded and the matches are included in the search.  If expanded is
     * unset then the wildcard was not specific enough and therefore no wildcard matches are included
     * (exact-match is included in results).
     * 
     * @Accessor(getter="getQueryInfo", setter="setQueryInfo")
     * @SerializedName("info")
     * @Type("Zimbra\Mail\Struct\SearchQueryInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     * @var SearchQueryInfo
     */
    private $queryInfo;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  int $num
     * @param  int $totalSize
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  array $messages
     * @param  SearchQueryInfo $queryInfo
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?int $num = NULL,
        ?int $totalSize = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        array $messages = [],
        ?SearchQueryInfo $queryInfo = NULL
    )
    {
        $this->setMessages($messages);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $num) {
            $this->setNum($num);
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
        if ($queryInfo instanceof SearchQueryInfo) {
            $this->setQueryInfo($queryInfo);
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
     * Get the flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Set the flags
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
     * Get the tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Set the tags
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
     * Get the tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Set the tagNames
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
     * Add message hit
     *
     * @param  MessageHitInfo $message
     * @return self
     */
    public function addMessage(MessageHitInfo $message): self
    {
        $this->messages[] = $message;
        return $this;
    }

    /**
     * Set messages
     *
     * @param  array $messages
     * @return self
     */
    public function setMessages(array $messages): self
    {
        $this->messages = array_filter($messages, static fn($message) => $message instanceof MessageHitInfo);
        return $this;
    }

    /**
     * Get messages
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * Get the queryInfo
     *
     * @return SearchQueryInfo
     */
    public function getQueryInfo(): ?SearchQueryInfo
    {
        return $this->queryInfo;
    }

    /**
     * Set the queryInfo
     *
     * @param  SearchQueryInfo $queryInfo
     * @return self
     */
    public function setQueryInfo(SearchQueryInfo $queryInfo): self
    {
        $this->queryInfo = $queryInfo;
        return $this;
    }
}
