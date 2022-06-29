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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class NewMountpointSpec
{
    /**
     * Mountpoint name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * (optional) Default type for the folder; used by web client to decide which view to use;
     * possible values are the same as <SearchRequest>'s {types}: <b>conversation|message|contact|etc</b>
     * @Accessor(getter="getDefaultView", setter="setDefaultView")
     * @SerializedName("view")
     * @Type("Zimbra\Common\Enum\ViewType")
     * @XmlAttribute
     */
    private ?ViewType $defaultView = NULL;

    /**
     * Flags
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
     * URL (RSS, iCal, etc.) this folder syncs its contents to
     * @Accessor(getter="getUrl", setter="setUrl")
     * @SerializedName("url")
     * @Type("string")
     * @XmlAttribute
     */
    private $url;

    /**
     * Parent folder ID
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * If set, the server will fetch the folder if it already exists rather than throwing mail.ALREADY_EXISTS
     * @Accessor(getter="getFetchIfExists", setter="setFetchIfExists")
     * @SerializedName("fie")
     * @Type("bool")
     * @XmlAttribute
     */
    private $fetchIfExists;

    /**
     * If set, client should display reminders for shared appointments/tasks
     * @Accessor(getter="getReminderEnabled", setter="setReminderEnabled")
     * @SerializedName("reminder")
     * @Type("bool")
     * @XmlAttribute
     */
    private $reminderEnabled;

    /**
     * Zimbra ID (guid) of the owner of the linked-to resource
     * @Accessor(getter="getOwnerId", setter="setOwnerId")
     * @SerializedName("zid")
     * @Type("string")
     * @XmlAttribute
     */
    private $ownerId;

    /**
     * Primary email address of the owner of the linked-to resource
     * @Accessor(getter="getOwnerName", setter="setOwnerName")
     * @SerializedName("owner")
     * @Type("string")
     * @XmlAttribute
     */
    private $ownerName;

    /**
     * Item ID of the linked-to resource in the remote mailbox
     * @Accessor(getter="getRemoteId", setter="setRemoteId")
     * @SerializedName("rid")
     * @Type("integer")
     * @XmlAttribute
     */
    private $remoteId;

    /**
     * Path to shared item
     * @Accessor(getter="getPath", setter="setPath")
     * @SerializedName("path")
     * @Type("string")
     * @XmlAttribute
     */
    private $path;

    /**
     * Constructor method for NewMountpointSpec
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
        string $name = '',
        string $folderId = '',
        ?ViewType $defaultView = NULL,
        ?string $flags = NULL,
        ?int $color = NULL,
        ?string $rgb = NULL,
        ?string $url = NULL,
        ?bool $fetchIfExists = NULL,
        ?bool $reminderEnabled = NULL,
        ?string $ownerId = NULL,
        ?string $ownerName = NULL,
        ?int $remoteId = NULL,
        ?string $path = NULL
    )
    {
        $this->setName($name)
             ->setFolderId($folderId);
        if ($defaultView instanceof ViewType) {
            $this->setDefaultView($defaultView);
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
        if (NULL !== $url) {
            $this->setUrl($url);
        }
        if (NULL !== $fetchIfExists) {
            $this->setFetchIfExists($fetchIfExists);
        }
        if (NULL !== $reminderEnabled) {
            $this->setReminderEnabled($reminderEnabled);
        }
        if (NULL !== $ownerId) {
            $this->setOwnerId($ownerId);
        }
        if (NULL !== $ownerName) {
            $this->setOwnerName($ownerName);
        }
        if (NULL !== $remoteId) {
            $this->setRemoteId($remoteId);
        }
        if (NULL !== $path) {
            $this->setPath($path);
        }
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
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
     * Gets parentFolderId
     *
     * @return string
     */
    public function getFolderId(): string
    {
        return $this->parentFolderId;
    }

    /**
     * Sets parentFolderId
     *
     * @param  string $parentFolderId
     * @return self
     */
    public function setFolderId(string $parentFolderId): self
    {
        $this->parentFolderId = $parentFolderId;
        return $this;
    }

    /**
     * Gets defaultView
     *
     * @return ViewType
     */
    public function getDefaultView(): ?ViewType
    {
        return $this->defaultView;
    }

    /**
     * Sets defaultView
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
     * Gets flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Sets flags
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
     * Gets color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Sets color
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
     * Gets rgb
     *
     * @return string
     */
    public function getRgb(): ?string
    {
        return $this->rgb;
    }

    /**
     * Sets rgb
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
     * Gets url
     *
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Sets url
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
     * Gets fetchIfExists
     *
     * @return bool
     */
    public function getFetchIfExists(): ?bool
    {
        return $this->fetchIfExists;
    }

    /**
     * Sets fetchIfExists
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
     * Gets reminderEnabled
     *
     * @return bool
     */
    public function getReminderEnabled(): ?bool
    {
        return $this->reminderEnabled;
    }

    /**
     * Sets reminderEnabled
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
     * Gets ownerId
     *
     * @return string
     */
    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    /**
     * Sets ownerId
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
     * Gets ownerName
     *
     * @return string
     */
    public function getOwnerName(): ?string
    {
        return $this->ownerName;
    }

    /**
     * Sets ownerName
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
     * Gets remoteId
     *
     * @return int
     */
    public function getRemoteId(): ?int
    {
        return $this->remoteId;
    }

    /**
     * Sets remoteId
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
     * Gets path
     *
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Sets path
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
