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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Enum\ViewType;

/**
 * SyncFolder class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SyncFolder extends Folder
{
    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getTagItemIds", setter="setTagItemIds")
     * @Type("array<Zimbra\Mail\Struct\TagIdsAttr>")
     * @XmlList(inline=true, entry="tag", namespace="urn:zimbraMail")
     */
    private $tagItemIds = [];

    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getConvItemIds", setter="setConvItemIds")
     * @Type("array<Zimbra\Mail\Struct\ConvIdsAttr>")
     * @XmlList(inline=true, entry="c", namespace="urn:zimbraMail")
     */
    private $convItemIds = [];

    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getChatItemIds", setter="setChatItemIds")
     * @Type("array<Zimbra\Mail\Struct\ChatIdsAttr>")
     * @XmlList(inline=true, entry="chat", namespace="urn:zimbraMail")
     */
    private $chatItemIds = [];

    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getMsgItemIds", setter="setMsgItemIds")
     * @Type("array<Zimbra\Mail\Struct\MsgIdsAttr>")
     * @XmlList(inline=true, entry="m", namespace="urn:zimbraMail")
     */
    private $msgItemIds = [];

    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getContactItemIds", setter="setContactItemIds")
     * @Type("array<Zimbra\Mail\Struct\ContactIdsAttr>")
     * @XmlList(inline=true, entry="cn", namespace="urn:zimbraMail")
     */
    private $contactItemIds = [];

    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getApptItemIds", setter="setApptItemIds")
     * @Type("array<Zimbra\Mail\Struct\ApptIdsAttr>")
     * @XmlList(inline=true, entry="appt", namespace="urn:zimbraMail")
     */
    private $apptItemIds = [];

    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getTaskItemIds", setter="setTaskItemIds")
     * @Type("array<Zimbra\Mail\Struct\TaskIdsAttr>")
     * @XmlList(inline=true, entry="task", namespace="urn:zimbraMail")
     */
    private $taskItemIds = [];

    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getNoteItemIds", setter="setNoteItemIds")
     * @Type("array<Zimbra\Mail\Struct\NoteIdsAttr>")
     * @XmlList(inline=true, entry="notes", namespace="urn:zimbraMail")
     */
    private $noteItemIds = [];

    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getWikiItemIds", setter="setWikiItemIds")
     * @Type("array<Zimbra\Mail\Struct\WikiIdsAttr>")
     * @XmlList(inline=true, entry="w", namespace="urn:zimbraMail")
     */
    private $wikiItemIds = [];

    /**
     * list of item ids in the folder
     * 
     * @Accessor(getter="getDocItemIds", setter="setDocItemIds")
     * @Type("array<Zimbra\Mail\Struct\DocIdsAttr>")
     * @XmlList(inline=true, entry="doc", namespace="urn:zimbraMail")
     */
    private $docItemIds = [];

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $uuid
     * @param  array $itemIds
     * @param  string $name
     * @param  string $absoluteFolderPath
     * @param  string $parentId
     * @param  string $folderUuid
     * @param  string $flags
     * @param  int $color
     * @param  string $rgb
     * @param  int $unreadCount
     * @param  int $imapUnreadCount
     * @param  ViewType $view
     * @param  int $revision
     * @param  int $modifiedSequence
     * @param  int $changeDate
     * @param  int $itemCount
     * @param  int $imapItemCount
     * @param  int $totalSize
     * @param  int $imapModifiedSequence
     * @param  int $imapUidNext
     * @param  string $url
     * @param  bool $activeSyncDisabled
     * @param  int $webOfflineSyncDays
     * @param  string $perm
     * @param  bool $recursive
     * @param  string $restUrl
     * @param  bool $deletable
     * @param  array $metadatas
     * @param  Acl $acl
     * @param  array $subFolders
     * @param  array $mountpoints
     * @param  array $searchFolders
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function __construct(
        string $id = '',
        string $uuid = '',
        array $itemIds = [],
        ?string $name = NULL,
        ?string $absoluteFolderPath = NULL,
        ?string $parentId = NULL,
        ?string $folderUuid = NULL,
        ?string $flags = NULL,
        ?int $color = NULL,
        ?string $rgb = NULL,
        ?int $unreadCount = NULL,
        ?int $imapUnreadCount = NULL,
        ?ViewType $view = NULL,
        ?int $revision = NULL,
        ?int $modifiedSequence = NULL,
        ?int $changeDate = NULL,
        ?int $itemCount = NULL,
        ?int $imapItemCount = NULL,
        ?int $totalSize = NULL,
        ?int $imapModifiedSequence = NULL,
        ?int $imapUidNext = NULL,
        ?string $url = NULL,
        ?bool $activeSyncDisabled = NULL,
        ?int $webOfflineSyncDays = NULL,
        ?string $perm = NULL,
        ?bool $recursive = NULL,
        ?string $restUrl = NULL,
        ?bool $deletable = NULL,
        array $metadatas = [],
        ?Acl $acl = NULL,
        array $subFolders = [],
        array $mountpoints = [],
        array $searchFolders = [],
        ?RetentionPolicy $retentionPolicy = NULL
    )
    {
        parent::__construct(
            $id,
            $uuid,
            $name,
            $absoluteFolderPath,
            $parentId,
            $folderUuid,
            $flags,
            $color,
            $rgb,
            $unreadCount,
            $imapUnreadCount,
            $view,
            $revision,
            $modifiedSequence,
            $changeDate,
            $itemCount,
            $imapItemCount,
            $totalSize,
            $imapModifiedSequence,
            $imapUidNext,
            $url,
            $activeSyncDisabled,
            $webOfflineSyncDays,
            $perm,
            $recursive,
            $restUrl,
            $deletable,
            $metadatas,
            $acl,
            $subFolders,
            $mountpoints,
            $searchFolders,
            $retentionPolicy
        );
        $this->setItemIds($itemIds);
    }

    /**
     * Set itemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setItemIds(array $itemIds = []): self
    {
        $this->setTagItemIds($itemIds)
             ->setConvItemIds($itemIds)
             ->setChatItemIds($itemIds)
             ->setMsgItemIds($itemIds)
             ->setContactItemIds($itemIds)
             ->setApptItemIds($itemIds)
             ->setTaskItemIds($itemIds)
             ->setNoteItemIds($itemIds)
             ->setWikiItemIds($itemIds)
             ->setDocItemIds($itemIds);
        return $this;
    }

    /**
     * Get types
     *
     * @return array
     */
    public function getItemIds(): array
    {
        return array_merge(
            $this->tagItemIds,
            $this->convItemIds,
            $this->chatItemIds,
            $this->msgItemIds,
            $this->contactItemIds,
            $this->apptItemIds,
            $this->taskItemIds,
            $this->noteItemIds,
            $this->wikiItemIds,
            $this->docItemIds
        );
    }

    /**
     * Set tagItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setTagItemIds(array $itemIds): self
    {
        $this->tagItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof TagIdsAttr)
        );
        return $this;
    }

    /**
     * Get tagItemIds
     *
     * @return array
     */
    public function getTagItemIds(): array
    {
        return $this->tagItemIds;
    }

    /**
     * Set convItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setConvItemIds(array $itemIds): self
    {
        $this->convItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof ConvIdsAttr)
        );
        return $this;
    }

    /**
     * Get convItemIds
     *
     * @return array
     */
    public function getConvItemIds(): array
    {
        return $this->convItemIds;
    }

    /**
     * Set chatItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setChatItemIds(array $itemIds): self
    {
        $this->chatItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof ChatIdsAttr)
        );
        return $this;
    }

    /**
     * Get chatItemIds
     *
     * @return array
     */
    public function getChatItemIds(): array
    {
        return $this->chatItemIds;
    }

    /**
     * Set msgItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setMsgItemIds(array $itemIds): self
    {
        $this->msgItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof MsgIdsAttr)
        );
        return $this;
    }

    /**
     * Get msgItemIds
     *
     * @return array
     */
    public function getMsgItemIds(): array
    {
        return $this->msgItemIds;
    }

    /**
     * Set contactItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setContactItemIds(array $itemIds): self
    {
        $this->contactItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof ContactIdsAttr)
        );
        return $this;
    }

    /**
     * Get contactItemIds
     *
     * @return array
     */
    public function getContactItemIds(): array
    {
        return $this->contactItemIds;
    }

    /**
     * Set apptItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setApptItemIds(array $itemIds): self
    {
        $this->apptItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof ApptIdsAttr)
        );
        return $this;
    }

    /**
     * Get apptItemIds
     *
     * @return array
     */
    public function getApptItemIds(): array
    {
        return $this->apptItemIds;
    }

    /**
     * Set taskItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setTaskItemIds(array $itemIds): self
    {
        $this->taskItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof TaskIdsAttr)
        );
        return $this;
    }

    /**
     * Get taskItemIds
     *
     * @return array
     */
    public function getTaskItemIds(): array
    {
        return $this->taskItemIds;
    }

    /**
     * Set noteItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setNoteItemIds(array $itemIds): self
    {
        $this->noteItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof NoteIdsAttr)
        );
        return $this;
    }

    /**
     * Get noteItemIds
     *
     * @return array
     */
    public function getNoteItemIds(): array
    {
        return $this->noteItemIds;
    }

    /**
     * Set wikiItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setWikiItemIds(array $itemIds): self
    {
        $this->wikiItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof WikiIdsAttr)
        );
        return $this;
    }

    /**
     * Get wikiItemIds
     *
     * @return array
     */
    public function getWikiItemIds(): array
    {
        return $this->wikiItemIds;
    }

    /**
     * Set docItemIds
     *
     * @param  array $itemIds
     * @return self
     */
    public function setDocItemIds(array $itemIds): self
    {
        $this->docItemIds = array_values(
            array_filter($itemIds, static fn ($item) => $item instanceof DocIdsAttr)
        );
        return $this;
    }

    /**
     * Get docItemIds
     *
     * @return array
     */
    public function getDocItemIds(): array
    {
        return $this->docItemIds;
    }
}
