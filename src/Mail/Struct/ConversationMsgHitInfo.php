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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * ConversationMsgHitInfo struct class
 * Conversation search result information containing messages
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConversationMsgHitInfo
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
     * Size
     * 
     * @var int
     */
    #[Accessor(getter: 'getSize', setter: 'setSize')]
    #[SerializedName(name: 's')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $size;

    /**
     * Folder ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName(name: 'l')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * flags
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName(name: 'f')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $flags;

    /**
     * Can optionally set autoSendTime to specify the time at which the draft should be
     * automatically sent by the server
     * 
     * @var int
     */
    #[Accessor(getter: 'getAutoSendTime', setter: 'setAutoSendTime')]
    #[SerializedName(name: 'autoSendTime')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $autoSendTime;

    /**
     * date
     * 
     * @var int
     */
    #[Accessor(getter: 'getDate', setter: 'setDate')]
    #[SerializedName(name: 'd')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $date;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  int $size
     * @param  string $folderId
     * @param  string $flags
     * @param  int $autoSendTime
     * @param  int $date
     * @return self
     */
    public function __construct(
        string $id = '',
        ?int $size = NULL,
        ?string $folderId = NULL,
        ?string $flags = NULL,
        ?int $autoSendTime = NULL,
        ?int $date = NULL
    )
    {
        $this->setId($id);
        if (NULL !== $size) {
            $this->setSize($size);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $autoSendTime) {
            $this->setAutoSendTime($autoSendTime);
        }
        if (NULL !== $date) {
            $this->setDate($date);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): string
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
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
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
     * Get autoSendTime
     *
     * @return int
     */
    public function getAutoSendTime(): ?int
    {
        return $this->autoSendTime;
    }

    /**
     * Set autoSendTime
     *
     * @param  int $autoSendTime
     * @return self
     */
    public function setAutoSendTime(int $autoSendTime): self
    {
        $this->autoSendTime = $autoSendTime;
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
}
