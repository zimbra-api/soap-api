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

/**
 * PendingFolderModifications struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 */
class PendingFolderModifications
{
    /**
     * ID of signaled folder
     *
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("id")]
    #[Type("int")]
    #[XmlAttribute]
    private $folderId;

    /**
     * list of created items
     *
     * @Accessor(getter="getCreated", setter="setCreated")
     * @Type("array<Zimbra\Mail\Struct\CreateItemNotification>")
     * @XmlList(inline=true, entry="created", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getCreated", setter: "setCreated")]
    #[Type("array<Zimbra\Mail\Struct\CreateItemNotification>")]
    #[XmlList(inline: true, entry: "created", namespace: "urn:zimbraMail")]
    private $created = [];

    /**
     * list of deleted items
     *
     * @Accessor(getter="getDeleted", setter="setDeleted")
     * @Type("array<Zimbra\Mail\Struct\DeleteItemNotification>")
     * @XmlList(inline=true, entry="deleted", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getDeleted", setter: "setDeleted")]
    #[Type("array<Zimbra\Mail\Struct\DeleteItemNotification>")]
    #[XmlList(inline: true, entry: "deleted", namespace: "urn:zimbraMail")]
    private $deleted = [];

    /**
     * list of modified messages
     *
     * @Accessor(getter="getModifiedMsgs", setter="setModifiedMsgs")
     * @Type("array<Zimbra\Mail\Struct\ModifyItemNotification>")
     * @XmlList(inline=true, entry="modMsgs", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getModifiedMsgs", setter: "setModifiedMsgs")]
    #[Type("array<Zimbra\Mail\Struct\ModifyItemNotification>")]
    #[XmlList(inline: true, entry: "modMsgs", namespace: "urn:zimbraMail")]
    private $modifiedMsgs = [];

    /**
     * list of modified tags
     *
     * @Accessor(getter="getModifiedTags", setter="setModifiedTags")
     * @Type("array<Zimbra\Mail\Struct\ModifyTagNotification>")
     * @XmlList(inline=true, entry="modTags", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getModifiedTags", setter: "setModifiedTags")]
    #[Type("array<Zimbra\Mail\Struct\ModifyTagNotification>")]
    #[XmlList(inline: true, entry: "modTags", namespace: "urn:zimbraMail")]
    private $modifiedTags = [];

    /**
     * list of renamed folders
     *
     * @Accessor(getter="getRenamedFolders", setter="setRenamedFolders")
     * @Type("array<Zimbra\Mail\Struct\RenameFolderNotification>")
     * @XmlList(inline=true, entry="modFolders", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getRenamedFolders", setter: "setRenamedFolders")]
    #[Type("array<Zimbra\Mail\Struct\RenameFolderNotification>")]
    #[XmlList(inline: true, entry: "modFolders", namespace: "urn:zimbraMail")]
    private $modifiedFolders = [];

    /**
     * Constructor
     *
     * @param  int $folderId
     * @param  array $created
     * @param  array $deleted
     * @param  array $modifiedMsgs
     * @param  array $modifiedTags
     * @param  array $modifiedFolders
     * @return self
     */
    public function __construct(
        int $folderId = 0,
        array $created = [],
        array $deleted = [],
        array $modifiedMsgs = [],
        array $modifiedTags = [],
        array $modifiedFolders = []
    ) {
        $this->setFolderId($folderId)
            ->setCreated($created)
            ->setDeleted($deleted)
            ->setModifiedMsgs($modifiedMsgs)
            ->setModifiedTags($modifiedTags)
            ->setRenamedFolders($modifiedFolders);
    }

    /**
     * Get folder id
     *
     * @return int
     */
    public function getFolderId(): int
    {
        return $this->folderId;
    }

    /**
     * Set folder id
     *
     * @param  int $folderId
     * @return self
     */
    public function setFolderId(int $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Add created item
     *
     * @param  CreateItemNotification $item
     * @return self
     */
    public function addCreatedItem(CreateItemNotification $item): self
    {
        $this->created[] = $item;
        return $this;
    }

    /**
     * Set created sequence
     *
     * @param array $created
     * @return self
     */
    public function setCreated(array $created): self
    {
        $this->created = array_filter(
            $created,
            static fn($item) => $item instanceof CreateItemNotification
        );
        return $this;
    }

    /**
     * Get created sequence
     *
     * @return array
     */
    public function getCreated(): ?array
    {
        return $this->created;
    }

    /**
     * Add deleted item
     *
     * @param  DeleteItemNotification $item
     * @return self
     */
    public function addDeletedItem(DeleteItemNotification $item): self
    {
        $this->deleted[] = $item;
        return $this;
    }

    /**
     * Set deleted sequence
     *
     * @param array $deleted
     * @return self
     */
    public function setDeleted(array $deleted): self
    {
        $this->deleted = array_filter(
            $deleted,
            static fn($item) => $item instanceof DeleteItemNotification
        );
        return $this;
    }

    /**
     * Get deleted sequence
     *
     * @return array
     */
    public function getDeleted(): ?array
    {
        return $this->deleted;
    }

    /**
     * Add modified message
     *
     * @param  ModifyItemNotification $item
     * @return self
     */
    public function addModifiedMsg(ModifyItemNotification $item): self
    {
        $this->modifiedMsgs[] = $item;
        return $this;
    }

    /**
     * Set modified messages
     *
     * @param array $msgs
     * @return self
     */
    public function setModifiedMsgs(array $msgs): self
    {
        $this->modifiedMsgs = array_filter(
            $msgs,
            static fn($msg) => $msg instanceof ModifyItemNotification
        );
        return $this;
    }

    /**
     * Get modified messages
     *
     * @return array
     */
    public function getModifiedMsgs(): ?array
    {
        return $this->modifiedMsgs;
    }

    /**
     * Add modified tag
     *
     * @param  ModifyTagNotification $item
     * @return self
     */
    public function addModifiedTag(ModifyTagNotification $item): self
    {
        $this->modifiedTags[] = $item;
        return $this;
    }

    /**
     * Set modified tags
     *
     * @param array $tags
     * @return self
     */
    public function setModifiedTags(array $tags): self
    {
        $this->modifiedTags = array_filter(
            $tags,
            static fn($tag) => $tag instanceof ModifyTagNotification
        );
        return $this;
    }

    /**
     * Get modified tags
     *
     * @return array
     */
    public function getModifiedTags(): ?array
    {
        return $this->modifiedTags;
    }

    /**
     * Add renamed folder
     *
     * @param  RenameFolderNotification $item
     * @return self
     */
    public function addRenamedFolder(RenameFolderNotification $item): self
    {
        $this->modifiedFolders[] = $item;
        return $this;
    }

    /**
     * Set renamed folders
     *
     * @param array $folders
     * @return self
     */
    public function setRenamedFolders(array $folders): self
    {
        $this->modifiedFolders = array_filter(
            $folders,
            static fn($folder) => $folder instanceof RenameFolderNotification
        );
        return $this;
    }

    /**
     * Get renamed folders
     *
     * @return array
     */
    public function getRenamedFolders(): ?array
    {
        return $this->modifiedFolders;
    }
}
