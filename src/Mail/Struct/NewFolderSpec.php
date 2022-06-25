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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Enum\ViewType;
use Zimbra\Common\Text;

/**
 * NewFolderSpec class
 * Input for creating a new folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class NewFolderSpec
{
    /**
     * If parentFolderId is unset, name is the full path of the new folder; otherwise, name may not contain the folder separator '/'
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Default type for the folder; used by web client to decide which view to use;
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
     * @Accessor(getter="getParentFolderId", setter="setParentFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $parentFolderId;

    /**
     * If set, the server will fetch the folder if it already exists rather than throwing mail.ALREADY_EXISTS
     * @Accessor(getter="getFetchIfExists", setter="setFetchIfExists")
     * @SerializedName("fie")
     * @Type("bool")
     * @XmlAttribute
     */
    private $fetchIfExists;

    /**
     * If set (default) then if "url" is set, synchronize folder content on folder creation
     * @Accessor(getter="getSyncToUrl", setter="setSyncToUrl")
     * @SerializedName("sync")
     * @Type("bool")
     * @XmlAttribute
     */
    private $syncToUrl;

    /**
     * Grant specification
     * @Accessor(getter="getGrants", setter="setGrants")
     * @SerializedName("acl")
     * @Type("array<Zimbra\Mail\Struct\ActionGrantSelector>")
     * @XmlList(inline=false, entry="grant")
     */
    private $grants = [];

    /**
     * Constructor method for NewFolderSpec
     *
     * @param  string $name
     * @param  string $parentFolderId
     * @param  ViewType $defaultView
     * @param  string $flags
     * @param  int $color
     * @param  string $rgb
     * @param  string $url
     * @param  bool $fetchIfExists
     * @param  bool $syncToUrl
     * @param  array $grants
     * @return self
     */
    public function __construct(
        string $name,
        string $parentFolderId,
        ?ViewType $defaultView = NULL,
        ?string $flags = NULL,
        ?int $color = NULL,
        ?string $rgb = NULL,
        ?string $url = NULL,
        ?bool $fetchIfExists = NULL,
        ?bool $syncToUrl = NULL,
        array $grants = []
    )
    {
        $this->setName($name)
             ->setParentFolderId($parentFolderId)
             ->setGrants($grants);
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
        if (NULL !== $syncToUrl) {
            $this->setSyncToUrl($syncToUrl);
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
    public function getParentFolderId(): string
    {
        return $this->parentFolderId;
    }

    /**
     * Sets parentFolderId
     *
     * @param  string $parentFolderId
     * @return self
     */
    public function setParentFolderId(string $parentFolderId): self
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
        if (Text::isRgb($rgb)) {
            $this->rgb = $rgb;
        }
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
     * Gets syncToUrl
     *
     * @return bool
     */
    public function getSyncToUrl(): ?bool
    {
        return $this->syncToUrl;
    }

    /**
     * Sets syncToUrl
     *
     * @param  bool $syncToUrl
     * @return self
     */
    public function setSyncToUrl(bool $syncToUrl): self
    {
        $this->syncToUrl = $syncToUrl;
        return $this;
    }

    /**
     * Sets grants
     *
     * @param  array $grants
     * @return self
     */
    public function setGrants(array $grants): self
    {
        $this->grants = array_filter($grants, static fn ($grant) => $grant instanceof ActionGrantSelector);
        return $this;
    }

    /**
     * Gets grants
     *
     * @return array
     */
    public function getGrants(): array
    {
        return $this->grants;
    }

    /**
     * Add grant
     *
     * @param  ActionGrantSelector $grant
     * @return self
     */
    public function addGrant(ActionGrantSelector $grant): self
    {
        $this->grants[] = $grant;
        return $this;
    }
}
