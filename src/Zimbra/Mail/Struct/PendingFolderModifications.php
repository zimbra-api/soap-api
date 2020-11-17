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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};

/**
 * PendingFolderModifications struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="mods")
 */
class PendingFolderModifications
{
    /**
     * ID of signaled folder
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * list of created items
     * @Accessor(getter="getCreated", setter="setCreated")
     * @SerializedName("created")
     * @Type("array<Zimbra\Mail\Struct\CreateItemNotification>")
     * @XmlList(inline = true, entry = "created")
     */
    private $created;

    /**
     * list of deleted items
     * @Accessor(getter="getDeleted", setter="setDeleted")
     * @SerializedName("deleted")
     * @Type("array<Zimbra\Mail\Struct\DeleteItemNotification>")
     * @XmlList(inline = true, entry = "deleted")
     */
    private $deleted;

    /**
     * list of modified messages
     * @Accessor(getter="getModifiedMsgs", setter="setModifiedMsgs")
     * @SerializedName("modMsgs")
     * @Type("array<Zimbra\Mail\Struct\ModifyItemNotification>")
     * @XmlList(inline = true, entry = "modMsgs")
     */
    private $modifiedMsgs;

    /**
     * list of modified tags
     * @Accessor(getter="getModifiedTags", setter="setModifiedTags")
     * @SerializedName("modTags")
     * @Type("array<Zimbra\Mail\Struct\ModifyTagNotification>")
     * @XmlList(inline = true, entry = "modTags")
     */
    private $modifiedTags;

    /**
     * list of renamed folders
     * @Accessor(getter="getRenamedFolders", setter="setRenamedFolders")
     * @SerializedName("modFolders")
     * @Type("array<Zimbra\Mail\Struct\RenameFolderNotification>")
     * @XmlList(inline = true, entry = "modFolders")
     */
    private $modifiedFolders;

    /**
     * Constructor method for PendingFolderModifications
     * @param  int $folderId
     * @param  array $created
     * @param  array $deleted
     * @param  array $modifiedMsgs
     * @param  array $modifiedTags
     * @param  array $modifiedFolders
     * @return self
     */
    public function __construct(
        $folderId,
        array $created = [],
        array $deleted = [],
        array $modifiedMsgs = [],
        array $modifiedTags = [],
        array $modifiedFolders = []
    )
    {
        $this->setFolderId($folderId)
             ->setCreated($created)
             ->setDeleted($deleted)
             ->setModifiedMsgs($modifiedMsgs)
             ->setModifiedTags($modifiedTags)
             ->setRenamedFolders($modifiedFolders);
    }

    /**
     * Gets folder id
     *
     * @return int
     */
    public function getFolderId(): int
    {
        return $this->folderId;
    }

    /**
     * Sets folder id
     *
     * @param  int $folderId
     * @return self
     */
    public function setFolderId($folderId): self
    {
        $this->folderId = (int) $folderId;
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
     * Sets created sequence
     *
     * @param array $created
     * @return self
     */
    public function setCreated(array $created): self
    {
        $this->created = [];
        foreach ($created as $item) {
            if ($item instanceof CreateItemNotification) {
                $this->created[] = $item;
            }
        }
        return $this;
    }

    /**
     * Gets created sequence
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
     * @param  DeleteItemNotification $attr
     * @return self
     */
    public function addDeletedItem(DeleteItemNotification $item): self
    {
        $this->deleted[] = $item;
        return $this;
    }

    /**
     * Sets deleted sequence
     *
     * @param array $deleted
     * @return self
     */
    public function setDeleted(array $deleted): self
    {
        $this->deleted = [];
        foreach ($deleted as $item) {
            if ($item instanceof DeleteItemNotification) {
                $this->deleted[] = $item;
            }
        }
        return $this;
    }

    /**
     * Gets deleted sequence
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
     * Sets modified messages
     *
     * @param array $modifiedMsgs
     * @return self
     */
    public function setModifiedMsgs(array $modifiedMsgs): self
    {
        $this->modifiedMsgs = [];
        foreach ($modifiedMsgs as $item) {
            if ($item instanceof ModifyItemNotification) {
                $this->modifiedMsgs[] = $item;
            }
        }
        return $this;
    }

    /**
     * Gets modified messages
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
     * Sets modified tags
     *
     * @param array $modifiedTags
     * @return self
     */
    public function setModifiedTags(array $modifiedTags): self
    {
        $this->modifiedTags = [];
        foreach ($modifiedTags as $item) {
            if ($item instanceof ModifyTagNotification) {
                $this->modifiedTags[] = $item;
            }
        }
        return $this;
    }

    /**
     * Gets modified tags
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
     * Sets renamed folders
     *
     * @param array $modifiedFolders
     * @return self
     */
    public function setRenamedFolders(array $modifiedFolders): self
    {
        $this->modifiedFolders = [];
        foreach ($modifiedFolders as $item) {
            if ($item instanceof RenameFolderNotification) {
                $this->modifiedFolders[] = $item;
            }
        }
        return $this;
    }

    /**
     * Gets renamed folders
     *
     * @return array
     */
    public function getRenamedFolders(): ?array
    {
        return $this->modifiedFolders;
    }
}
