<?php declare(strict_types=1);
/**
 * This file is name of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * ConversationInfo class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConversationInfo
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
     * Number of (nondeleted) messages
     * 
     * @var int
     */
    #[Accessor(getter: 'getNum', setter: 'setNum')]
    #[SerializedName('n')]
    #[Type('int')]
    #[XmlAttribute]
    private $num;

    /**
     * Total number of messages (including deleted messages).
     * Only included if value differs from {num-msgs}
     * 
     * @var int
     */
    #[Accessor(getter: 'getTotalSize', setter: 'setTotalSize')]
    #[SerializedName('total')]
    #[Type('int')]
    #[XmlAttribute]
    private $totalSize;

    /**
     * Flags
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName('f')]
    #[Type('string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Tags - Comma separated list of ints. DEPRECATED - use "tn" instead
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
     * Metadata and the subject as text
     * 
     * @var array
     */
    #[Accessor(getter: 'getMetadatas', setter: 'setMetadatas')]
    #[Type('array<Zimbra\Mail\Struct\MailCustomMetadata>')]
    #[XmlList(inline: true, entry: 'meta', namespace: 'urn:zimbraMail')]
    private $metadatas = [];

    /**
     * Subject
     * 
     * @var string
     */
    #[Accessor(getter: 'getSubject', setter: 'setSubject')]
    #[SerializedName('su')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $subject;

    /**
     * Chat messages
     * 
     * @var array
     */
    #[Accessor(getter: 'getChatMessages', setter: 'setChatMessages')]
    #[Type('array<Zimbra\Mail\Struct\ChatMessageInfo>')]
    #[XmlList(inline: true, entry: 'chat', namespace: 'urn:zimbraMail')]
    private $chatMessages = [];

    /**
     * Messages
     * 
     * @var array
     */
    #[Accessor(getter: 'getMessages', setter: 'setMessages')]
    #[Type('array<Zimbra\Mail\Struct\MessageInfo>')]
    #[XmlList(inline: true, entry: 'm', namespace: 'urn:zimbraMail')]
    private $messages = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  int $num
     * @param  int $totalSize
     * @param  string $flags
     * @param  string $tags
     * @param  string $tagNames
     * @param  string $subject
     * @param  array $metadatas
     * @param  array $chatMessages
     * @param  array $messages
     * @return self
     */
    public function __construct(
        ?string $id = null,
        ?int $num = null,
        ?int $totalSize = null,
        ?string $flags = null,
        ?string $tags = null,
        ?string $tagNames = null,
        ?string $subject = null,
        array $metadatas = [],
        array $chatMessages = [],
        array $messages = []
    )
    {
        $this->setMetadatas($metadatas)
             ->setChatMessages($chatMessages)
             ->setMessages($messages);
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $num) {
            $this->setNum($num);
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
     * Set metadatas
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        $this->metadatas = array_filter(
            $metadatas, static fn ($metadata) => $metadata instanceof MailCustomMetadata
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

    /**
     * Set chatMessages
     *
     * @param  array $messages
     * @return self
     */
    public function setChatMessages(array $messages): self
    {
        $this->chatMessages = array_filter(
            $messages, static fn ($msg) => $msg instanceof ChatMessageInfo
        );
        return $this;
    }

    /**
     * Get chatMessages
     *
     * @return array
     */
    public function getChatMessages(): array
    {
        return $this->chatMessages;
    }

    /**
     * Set messages
     *
     * @param  array $messages
     * @return self
     */
    public function setMessages(array $messages): self
    {
        $this->messages = array_filter(
            $messages, static fn ($msg) => $msg instanceof MessageInfo
        );
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
}
