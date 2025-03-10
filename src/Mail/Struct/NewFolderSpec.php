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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Common\Enum\ViewType;

/**
 * NewFolderSpec class
 * Input for creating a new folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NewFolderSpec
{
    /**
     * If parentFolderId is unset, name is the full path of the new folder; otherwise, name may not contain the folder separator '/'
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * Default type for the folder; used by web client to decide which view to use;
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
    #[Accessor(getter: "getParentFolderId", setter: "setParentFolderId")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private string $parentFolderId;

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
     * If set (default) then if "url" is set, synchronize folder content on folder creation
     *
     * @var bool
     */
    #[Accessor(getter: "getSyncToUrl", setter: "setSyncToUrl")]
    #[SerializedName("sync")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $syncToUrl = null;

    /**
     * Grant specification
     *
     * @var array
     */
    #[Accessor(getter: "getGrants", setter: "setGrants")]
    #[SerializedName("acl")]
    #[Type("array<Zimbra\Mail\Struct\ActionGrantSelector>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "grant", namespace: "urn:zimbraMail")]
    private array $grants = [];

    /**
     * Constructor
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
        string $name = "",
        string $parentFolderId = "",
        ?ViewType $defaultView = null,
        ?string $flags = null,
        ?int $color = null,
        ?string $rgb = null,
        ?string $url = null,
        ?bool $fetchIfExists = null,
        ?bool $syncToUrl = null,
        array $grants = []
    ) {
        $this->setName($name)
            ->setParentFolderId($parentFolderId)
            ->setGrants($grants);
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
        if (null !== $syncToUrl) {
            $this->setSyncToUrl($syncToUrl);
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
     * Get parentFolderId
     *
     * @return string
     */
    public function getParentFolderId(): string
    {
        return $this->parentFolderId;
    }

    /**
     * Set parentFolderId
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
     * Get syncToUrl
     *
     * @return bool
     */
    public function getSyncToUrl(): ?bool
    {
        return $this->syncToUrl;
    }

    /**
     * Set syncToUrl
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
     * Set grants
     *
     * @param  array $grants
     * @return self
     */
    public function setGrants(array $grants): self
    {
        $this->grants = array_filter(
            $grants,
            static fn($grant) => $grant instanceof ActionGrantSelector
        );
        return $this;
    }

    /**
     * Get grants
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
