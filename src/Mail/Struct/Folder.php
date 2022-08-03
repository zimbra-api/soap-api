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
use Zimbra\Common\Enum\ViewType;

/**
 * Folder class
 * A Folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Folder
{
    /**
     * The folder id
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Item's UUID - a globally unique identifier
     * @Accessor(getter="getUuid", setter="setUuid")
     * @SerializedName("uuid")
     * @Type("string")
     * @XmlAttribute
     */
    private $uuid;

    /**
     * Name of folder; max length 128; whitespace is trimmed by server;
     * Cannot contain ':', '"', '/', or any character below 0x20
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Absolute Folder path
     * @Accessor(getter="getAbsoluteFolderPath", setter="setAbsoluteFolderPath")
     * @SerializedName("absFolderPath")
     * @Type("string")
     * @XmlAttribute
     */
    private $absoluteFolderPath;

    /**
     * ID of parent folder (absent for root folder)
     * @Accessor(getter="getParentId", setter="setParentId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $parentId;

    /**
     * UUID of parent folder (absent for root folder)
     * @Accessor(getter="getFolderUuid", setter="setFolderUuid")
     * @SerializedName("luuid")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderUuid;

    /**
     * Flags - checked in UI (#), exclude free/(b)usy info, IMAP subscribed (*),
     * does not (i)nherit rights from parent, is a s(y)nc folder with external data source,
     * sync is turned on(~), folder does n(o)t allow inferiors / children
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     */
    private $flags;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * @Accessor(getter="getColor", setter="setColor")
     * @SerializedName("color")
     * @Type("integer")
     * @XmlAttribute
     */
    private $color;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     * @Accessor(getter="getRgb", setter="setRgb")
     * @SerializedName("rgb")
     * @Type("string")
     * @XmlAttribute
     */
    private $rgb;

    /**
     * Number of unread messages in folder
     * @Accessor(getter="getUnreadCount", setter="setUnreadCount")
     * @SerializedName("u")
     * @Type("integer")
     * @XmlAttribute
     */
    private $unreadCount;

    /**
     * Number of unread messages with this tag, including those with the IMAP \\Deleted flag set
     * @Accessor(getter="getImapUnreadCount", setter="setImapUnreadCount")
     * @SerializedName("i4u")
     * @Type("integer")
     * @XmlAttribute
     */
    private $imapUnreadCount;

    /**
     * Default type for the folder; used by web client to decide which view to use.
     * @Accessor(getter="getView", setter="setView")
     * @SerializedName("view")
     * @Type("Enum<Zimbra\Common\Enum\ViewType>")
     * @XmlAttribute
     */
    private ?ViewType $view = NULL;

    /**
     * Revision
     * @Accessor(getter="getRevision", setter="setRevision")
     * @SerializedName("rev")
     * @Type("integer")
     * @XmlAttribute
     */
    private $revision;

    /**
     * Modified sequence
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("integer")
     * @XmlAttribute
     */
    private $modifiedSequence;

    /**
     * Modified date in seconds
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("integer")
     * @XmlAttribute
     */
    private $changeDate;

    /**
     * Number of non-subfolder items in folder
     * @Accessor(getter="getItemCount", setter="setItemCount")
     * @SerializedName("n")
     * @Type("integer")
     * @XmlAttribute
     */
    private $itemCount;

    /**
     * Number of non-subfolder items in folder, including those with the IMAP \\Deleted flag set
     * @Accessor(getter="getImapItemCount", setter="setImapItemCount")
     * @SerializedName("i4n")
     * @Type("integer")
     * @XmlAttribute
     */
    private $imapItemCount;

    /**
     * Total size of all of non-subfolder items in folder
     * @Accessor(getter="getTotalSize", setter="setTotalSize")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $totalSize;

    /**
     * Imap modified sequence
     * @Accessor(getter="getImapModifiedSequence", setter="setImapModifiedSequence")
     * @SerializedName("i4ms")
     * @Type("integer")
     * @XmlAttribute
     */
    private $imapModifiedSequence;

    /**
     * IMAP UIDNEXT
     * @Accessor(getter="getImapUidNext", setter="setImapUidNext")
     * @SerializedName("i4next")
     * @Type("integer")
     * @XmlAttribute
     */
    private $imapUidNext;

    /**
     * URL (RSS, iCal, etc.) this folder syncs its contents to
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     */
    private $url;

    /**
     * Active sync status
     * @Accessor(getter="isActiveSyncDisabled", setter="setActiveSyncDisabled")
     * @SerializedName("activesyncdisabled")
     * @Type("bool")
     * @XmlAttribute
     */
    private $activeSyncDisabled;

    /**
     * Number of days for which web client would sync folder data for offline use
     * @Accessor(getter="getWebOfflineSyncDays", setter="setWebOfflineSyncDays")
     * @SerializedName("webOfflineSyncDays")
     * @Type("integer")
     * @XmlAttribute
     */
    private $webOfflineSyncDays;

    /**
     * For remote folders, the access rights the authenticated user has on the folder -
     * will contain the calculated (c)reate folder permission if the user has both (i)nsert and (r)ead access on the folder
     * @Accessor(getter="getPerm", setter="setPerm")
     * @SerializedName("perm")
     * @Type("string")
     * @XmlAttribute
     */
    private $perm;

    /**
     * Recursive
     * @Accessor(getter="getRecursive", setter="setRecursive")
     * @SerializedName("recursive")
     * @Type("bool")
     * @XmlAttribute
     */
    private $recursive;

    /**
     * URL to the folder in the REST interface for rest-enabled apps (such as notebook)
     * @Accessor(getter="getRestUrl", setter="setRestUrl")
     * @SerializedName("rest")
     * @Type("string")
     * @XmlAttribute
     */
    private $restUrl;

    /**
     * Whether this folder can be deleted
     * @Accessor(getter="isDeletable", setter="setDeletable")
     * @SerializedName("deletable")
     * @Type("bool")
     * @XmlAttribute
     */
    private $deletable;

    /**
     * Custom metadata
     * @Accessor(getter="getMetadatas", setter="setMetadatas")
     * @Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")
     * @XmlList(inline=true, entry="meta", namespace="urn:zimbraMail")
     */
    private $metadatas = [];

    /**
     * ACL for sharing
     * @Accessor(getter="getAcl", setter="setAcl")
     * @SerializedName("acl")
     * @Type("Zimbra\Mail\Struct\Acl")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?Acl $acl = NULL;

    /**
     * Sub folders
     * @Accessor(getter="getSubfolders", setter="setSubfolders")
     * @Type("array<Zimbra\Mail\Struct\Folder>")
     * @XmlList(inline=true, entry="folder", namespace="urn:zimbraMail")
     */
    private $subFolders = [];

    /**
     * Mount points
     * @Accessor(getter="getMountpoints", setter="setMountpoints")
     * @Type("array<Zimbra\Mail\Struct\Mountpoint>")
     * @XmlList(inline=true, entry="link", namespace="urn:zimbraMail")
     */
    private $mountpoints = [];

    /**
     * Search folders
     * @Accessor(getter="getSearchFolders", setter="setSearchFolders")
     * @Type("array<Zimbra\Mail\Struct\SearchFolder>")
     * @XmlList(inline=true, entry="search", namespace="urn:zimbraMail")
     */
    private $searchFolders = [];

    /**
     * Retention policy
     * @Accessor(getter="getRetentionPolicy", setter="setRetentionPolicy")
     * @SerializedName("retentionPolicy")
     * @Type("Zimbra\Mail\Struct\RetentionPolicy")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?RetentionPolicy $retentionPolicy = NULL;

    /**
     * Constructor method for Folder
     *
     * @param  string $id
     * @param  string $uuid
     * @return self
     */
    public function __construct(
        string $id = '',
        string $uuid = '',
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
        $this->setId($id)
             ->setUuid($uuid)
             ->setMetadatas($metadatas)
             ->setSubfolders($subFolders)
             ->setMountpoints($mountpoints)
             ->setSearchFolders($searchFolders);
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $absoluteFolderPath) {
            $this->setAbsoluteFolderPath($absoluteFolderPath);
        }
        if (NULL !== $parentId) {
            $this->setParentId($parentId);
        }
        if (NULL !== $folderUuid) {
            $this->setFolderUuid($folderUuid);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $color) {
            $this->setColor($color);
        }
        if (NULL !== $rgb) {
            $this->setRgb($rgb);
        }
        if (NULL !== $unreadCount) {
            $this->setUnreadCount($unreadCount);
        }
        if (NULL !== $imapUnreadCount) {
            $this->setImapUnreadCount($imapUnreadCount);
        }
        if ($view instanceof ViewType) {
            $this->setView($view);
        }
        if (NULL !== $revision) {
            $this->setRevision($revision);
        }
        if (NULL !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (NULL !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (NULL !== $itemCount) {
            $this->setItemCount($itemCount);
        }
        if (NULL !== $imapItemCount) {
            $this->setImapItemCount($imapItemCount);
        }
        if (NULL !== $totalSize) {
            $this->setTotalSize($totalSize);
        }
        if (NULL !== $imapModifiedSequence) {
            $this->setImapModifiedSequence($imapModifiedSequence);
        }
        if (NULL !== $imapUidNext) {
            $this->setImapUidNext($imapUidNext);
        }
        if (NULL !== $url) {
            $this->setUrl($url);
        }
        if (NULL !== $activeSyncDisabled) {
            $this->setActiveSyncDisabled($activeSyncDisabled);
        }
        if (NULL !== $webOfflineSyncDays) {
            $this->setWebOfflineSyncDays($webOfflineSyncDays);
        }
        if (NULL !== $perm) {
            $this->setPerm($perm);
        }
        if (NULL !== $recursive) {
            $this->setRecursive($recursive);
        }
        if (NULL !== $restUrl) {
            $this->setRestUrl($restUrl);
        }
        if (NULL !== $deletable) {
            $this->setDeletable($deletable);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if ($acl instanceof Acl) {
            $this->setAcl($acl);
        }
        if ($retentionPolicy instanceof RetentionPolicy) {
            $this->setRetentionPolicy($retentionPolicy);
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
     * Get uuid
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set uuid
     *
     * @param  string $uuid
     * @return self
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get absoluteFolderPath
     *
     * @return string
     */
    public function getAbsoluteFolderPath(): ?string
    {
        return $this->absoluteFolderPath;
    }

    /**
     * Set absoluteFolderPath
     *
     * @param  string $absoluteFolderPath
     * @return self
     */
    public function setAbsoluteFolderPath(string $absoluteFolderPath): self
    {
        $this->absoluteFolderPath = $absoluteFolderPath;
        return $this;
    }

    /**
     * Get parentId
     *
     * @return string
     */
    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    /**
     * Set parentId
     *
     * @param  string $parentId
     * @return self
     */
    public function setParentId(string $parentId): self
    {
        $this->parentId = $parentId;
        return $this;
    }

    /**
     * Get folderUuid
     *
     * @return string
     */
    public function getFolderUuid(): ?string
    {
        return $this->folderUuid;
    }

    /**
     * Set folderUuid
     *
     * @param  string $folderUuid
     * @return self
     */
    public function setFolderUuid(string $folderUuid): self
    {
        $this->folderUuid = $folderUuid;
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
     * Get color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Set color
     *
     * @param  int $color
     * @return self
     */
    public function setColor(int $color): self
    {
        $this->color = in_array($color, range(0, 127)) ? $color : 0;
        return $this;
    }

    /**
     * Get rgb
     *
     * @return string
     */
    public function getRgb(): ?string
    {
        return $this->rgb;
    }

    /**
     * Set rgb
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb(string $rgb): self
    {
        $this->rgb = $rgb;
        return $this;
    }

    /**
     * Get unreadCount
     *
     * @return int
     */
    public function getUnreadCount(): ?int
    {
        return $this->unreadCount;
    }

    /**
     * Set unreadCount
     *
     * @param  int $unreadCount
     * @return self
     */
    public function setUnreadCount(int $unreadCount): self
    {
        $this->unreadCount = $unreadCount;
        return $this;
    }

    /**
     * Get imapUnreadCount
     *
     * @return int
     */
    public function getImapUnreadCount(): ?int
    {
        return $this->imapUnreadCount;
    }

    /**
     * Set imapUnreadCount
     *
     * @param  int $imapUnreadCount
     * @return self
     */
    public function setImapUnreadCount(int $imapUnreadCount): self
    {
        $this->imapUnreadCount = $imapUnreadCount;
        return $this;
    }

    /**
     * Get view
     *
     * @return ViewType
     */
    public function getView(): ?ViewType
    {
        return $this->view;
    }

    /**
     * Set view
     *
     * @param  ViewType $view
     * @return self
     */
    public function setView(ViewType $view): self
    {
        $this->view = $view;
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
     * Get itemCount
     *
     * @return int
     */
    public function getItemCount(): ?int
    {
        return $this->itemCount;
    }

    /**
     * Set itemCount
     *
     * @param  int $itemCount
     * @return self
     */
    public function setItemCount(int $itemCount): self
    {
        $this->itemCount = $itemCount;
        return $this;
    }

    /**
     * Get imapItemCount
     *
     * @return int
     */
    public function getImapItemCount(): ?int
    {
        return $this->imapItemCount;
    }

    /**
     * Set imapItemCount
     *
     * @param  int $imapItemCount
     * @return self
     */
    public function setImapItemCount(int $imapItemCount): self
    {
        $this->imapItemCount = $imapItemCount;
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
     * Get imapModifiedSequence
     *
     * @return int
     */
    public function getImapModifiedSequence(): ?int
    {
        return $this->imapModifiedSequence;
    }

    /**
     * Set imapModifiedSequence
     *
     * @param  int $imapModifiedSequence
     * @return self
     */
    public function setImapModifiedSequence(int $imapModifiedSequence): self
    {
        $this->imapModifiedSequence = $imapModifiedSequence;
        return $this;
    }

    /**
     * Get imapUidNext
     *
     * @return int
     */
    public function getImapUidNext(): ?int
    {
        return $this->imapUidNext;
    }

    /**
     * Set imapUidNext
     *
     * @param  int $imapUidNext
     * @return self
     */
    public function setImapUidNext(int $imapUidNext): self
    {
        $this->imapUidNext = $imapUidNext;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set url
     *
     * @param  string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get activeSyncDisabled
     *
     * @return bool
     */
    public function isActiveSyncDisabled(): ?bool
    {
        return $this->activeSyncDisabled;
    }

    /**
     * Set activeSyncDisabled
     *
     * @param  bool $activeSyncDisabled
     * @return self
     */
    public function setActiveSyncDisabled(bool $activeSyncDisabled): self
    {
        $this->activeSyncDisabled = $activeSyncDisabled;
        return $this;
    }

    /**
     * Get webOfflineSyncDays
     *
     * @return int
     */
    public function getWebOfflineSyncDays(): ?int
    {
        return $this->webOfflineSyncDays;
    }

    /**
     * Set webOfflineSyncDays
     *
     * @param  int $webOfflineSyncDays
     * @return self
     */
    public function setWebOfflineSyncDays(int $webOfflineSyncDays): self
    {
        $this->webOfflineSyncDays = $webOfflineSyncDays;
        return $this;
    }

    /**
     * Get perm
     *
     * @return string
     */
    public function getPerm(): ?string
    {
        return $this->perm;
    }

    /**
     * Set perm
     *
     * @param  string $perm
     * @return self
     */
    public function setPerm(string $perm): self
    {
        $this->perm = $perm;
        return $this;
    }

    /**
     * Get recursive
     *
     * @return bool
     */
    public function getRecursive(): ?bool
    {
        return $this->recursive;
    }

    /**
     * Set recursive
     *
     * @param  bool $recursive
     * @return self
     */
    public function setRecursive(bool $recursive): self
    {
        $this->recursive = $recursive;
        return $this;
    }

    /**
     * Get restUrl
     *
     * @return string
     */
    public function getRestUrl(): ?string
    {
        return $this->restUrl;
    }

    /**
     * Set restUrl
     *
     * @param  string $restUrl
     * @return self
     */
    public function setRestUrl(string $restUrl): self
    {
        $this->restUrl = $restUrl;
        return $this;
    }

    /**
     * Get deletable
     *
     * @return bool
     */
    public function isDeletable(): ?bool
    {
        return $this->deletable;
    }

    /**
     * Set deletable
     *
     * @param  bool $deletable
     * @return self
     */
    public function setDeletable(bool $deletable): self
    {
        $this->deletable = $deletable;
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
        $this->metadatas = array_filter($metadatas, static fn ($metadata) => $metadata instanceof MailCustomMetadata);
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
     * Add metadata
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function addMetadata(MailCustomMetadata $metadata): self
    {
        $this->metadatas[] = $metadata;
        return $this;
    }

    /**
     * Get acl
     *
     * @return Acl
     */
    public function getAcl(): ?Acl
    {
        return $this->acl;
    }

    /**
     * Set acl
     *
     * @param  Acl $acl
     * @return self
     */
    public function setAcl(Acl $acl): self
    {
        $this->acl = $acl;
        return $this;
    }

    /**
     * Get subFolders
     *
     * @return array
     */
    public function getSubfolders(): array
    {
        return $this->subFolders;
    }

    /**
     * Set subFolders
     *
     * @param  array $subFolders
     * @return self
     */
    public function setSubfolders(array $subFolders): self
    {
        $this->subFolders = $subFolders;
        return $this;
    }

    /**
     * Get mountpoints
     *
     * @return array
     */
    public function getMountpoints(): array
    {
        return $this->mountpoints;
    }

    /**
     * Set mountpoints
     *
     * @param  array $mountpoints
     * @return self
     */
    public function setMountpoints(array $mountpoints): self
    {
        $this->mountpoints = $mountpoints;
        return $this;
    }

    /**
     * Get searchFolders
     *
     * @return array
     */
    public function getSearchFolders(): array
    {
        return $this->searchFolders;
    }

    /**
     * Set searchFolders
     *
     * @param  array $searchFolders
     * @return self
     */
    public function setSearchFolders(array $searchFolders): self
    {
        $this->searchFolders = $searchFolders;
        return $this;
    }

    /**
     * Get retentionPolicy
     *
     * @return RetentionPolicy
     */
    public function getRetentionPolicy(): ?RetentionPolicy
    {
        return $this->retentionPolicy;
    }

    /**
     * Set retentionPolicy
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function setRetentionPolicy(RetentionPolicy $retentionPolicy): self
    {
        $this->retentionPolicy = $retentionPolicy;
        return $this;
    }
}
