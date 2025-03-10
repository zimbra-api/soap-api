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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\ViewType;

/**
 * NewMountpointSpec class
 * Input for creating a new mountpoint
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NewMountpointSpec
{
    /**
     * Mountpoint name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * (optional) Default type for the folder; used by web client to decide which view to use;
     * possible values are the same as <SearchRequest>'s {types}: conversation|message|contact|etc
     *
     * @var ViewType
     */
    #[Accessor(getter: "getDefaultView", setter: "setDefaultView")]
    #[SerializedName("view")]
    #[XmlAttribute]
    private ?ViewType $defaultView;

    /**
     * Flags
     *
     * @var string
     */
    #[Accessor(getter: "getFlags", setter: "setFlags")]
    #[SerializedName("f")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $flags = null;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     *
     * @var int
     */
    #[Accessor(getter: "getColor", setter: "setColor")]
    #[SerializedName("color")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $color = null;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     *
     * @var string
     */
    #[Accessor(getter: "getRgb", setter: "setRgb")]
    #[SerializedName("rgb")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $rgb = null;

    /**
     * URL (RSS, iCal, etc.) this folder syncs its contents to
     *
     * @var string
     */
    #[Accessor(getter: "getUrl", setter: "setUrl")]
    #[SerializedName("url")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $url = null;

    /**
     * Parent folder ID
     *
     * @var string
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private string $folderId;

    /**
     * If set, the server will fetch the folder if it already exists rather than throwing mail.ALREADY_EXISTS
     *
     * @var bool
     */
    #[Accessor(getter: "getFetchIfExists", setter: "setFetchIfExists")]
    #[SerializedName("fie")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $fetchIfExists = null;

    /**
     * If set, client should display reminders for shared appointments/tasks
     *
     * @var bool
     */
    #[Accessor(getter: "getReminderEnabled", setter: "setReminderEnabled")]
    #[SerializedName("reminder")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $reminderEnabled = null;

    /**
     * Zimbra ID (guid) of the owner of the linked-to resource
     *
     * @var string
     */
    #[Accessor(getter: "getOwnerId", setter: "setOwnerId")]
    #[SerializedName("zid")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $ownerId = null;

    /**
     * Primary email address of the owner of the linked-to resource
     *
     * @var string
     */
    #[Accessor(getter: "getOwnerName", setter: "setOwnerName")]
    #[SerializedName("owner")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $ownerName = null;

    /**
     * Item ID of the linked-to resource in the remote mailbox
     *
     * @var int
     */
    #[Accessor(getter: "getRemoteId", setter: "setRemoteId")]
    #[SerializedName("rid")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $remoteId = null;

    /**
     * Path to shared item
     *
     * @var string
     */
    #[Accessor(getter: "getPath", setter: "setPath")]
    #[SerializedName("path")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $path = null;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  string $folderId
     * @param  ViewType $defaultView
     * @param  string $flags
     * @param  int $color
     * @param  string $rgb
     * @param  string $url
     * @param  bool $fetchIfExists
     * @param  bool $reminderEnabled
     * @param  string $ownerId
     * @param  string $ownerName
     * @param  int $remoteId
     * @param  string $path
     * @return self
     */
    public function __construct(
        string $name = "",
        string $folderId = "",
        ?ViewType $defaultView = null,
        ?string $flags = null,
        ?int $color = null,
        ?string $rgb = null,
        ?string $url = null,
        ?bool $fetchIfExists = null,
        ?bool $reminderEnabled = null,
        ?string $ownerId = null,
        ?string $ownerName = null,
        ?int $remoteId = null,
        ?string $path = null
    ) {
        $this->setName($name)->setFolderId($folderId);
        $this->defaultView = $defaultView;
        if (null !== $flags) {
            $this->setFlags($flags);
        }
        if (null !== $color) {
            $this->setColor($color);
        }
        if (null !== $rgb) {
            $this->setRgb($rgb);
        }
        if (null !== $url) {
            $this->setUrl($url);
        }
        if (null !== $fetchIfExists) {
            $this->setFetchIfExists($fetchIfExists);
        }
        if (null !== $reminderEnabled) {
            $this->setReminderEnabled($reminderEnabled);
        }
        if (null !== $ownerId) {
            $this->setOwnerId($ownerId);
        }
        if (null !== $ownerName) {
            $this->setOwnerName($ownerName);
        }
        if (null !== $remoteId) {
            $this->setRemoteId($remoteId);
        }
        if (null !== $path) {
            $this->setPath($path);
        }
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
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
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): string
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
     * Get defaultView
     *
     * @return ViewType
     */
    public function getDefaultView(): ?ViewType
    {
        return $this->defaultView;
    }

    /**
     * Set defaultView
     *
     * @param  ViewType $defaultView
     * @return self
     */
    public function setDefaultView(ViewType $defaultView): self
    {
        $this->defaultView = $defaultView;
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
     * Get fetchIfExists
     *
     * @return bool
     */
    public function getFetchIfExists(): ?bool
    {
        return $this->fetchIfExists;
    }

    /**
     * Set fetchIfExists
     *
     * @param  bool $fetchIfExists
     * @return self
     */
    public function setFetchIfExists(bool $fetchIfExists): self
    {
        $this->fetchIfExists = $fetchIfExists;
        return $this;
    }

    /**
     * Get reminderEnabled
     *
     * @return bool
     */
    public function getReminderEnabled(): ?bool
    {
        return $this->reminderEnabled;
    }

    /**
     * Set reminderEnabled
     *
     * @param  bool $reminderEnabled
     * @return self
     */
    public function setReminderEnabled(bool $reminderEnabled): self
    {
        $this->reminderEnabled = $reminderEnabled;
        return $this;
    }

    /**
     * Get ownerId
     *
     * @return string
     */
    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    /**
     * Set ownerId
     *
     * @param  string $ownerId
     * @return self
     */
    public function setOwnerId(string $ownerId): self
    {
        $this->ownerId = $ownerId;
        return $this;
    }

    /**
     * Get ownerName
     *
     * @return string
     */
    public function getOwnerName(): ?string
    {
        return $this->ownerName;
    }

    /**
     * Set ownerName
     *
     * @param  string $ownerName
     * @return self
     */
    public function setOwnerName(string $ownerName): self
    {
        $this->ownerName = $ownerName;
        return $this;
    }

    /**
     * Get remoteId
     *
     * @return int
     */
    public function getRemoteId(): ?int
    {
        return $this->remoteId;
    }

    /**
     * Set remoteId
     *
     * @param  int $remoteId
     * @return self
     */
    public function setRemoteId(int $remoteId): self
    {
        $this->remoteId = $remoteId;
        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Set path
     *
     * @param  string $path
     * @return self
     */
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }
}
