<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Common\Struct\{
    ZimletConfigInfo,
    ZimletGlobalConfigInfo,
    ZimletHostConfigInfo
};

/**
 * AdminZimletConfigInfo class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AdminZimletConfigInfo implements ZimletConfigInfo
{
    /**
     * Zimlet name
     *
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private $name;

    /**
     * Version string
     *
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("version")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getVersion", setter: "setVersion")]
    #[SerializedName("version")]
    #[Type("string")]
    #[XmlAttribute]
    private $version;

    /**
     * Zimlet description
     *
     * @Accessor(getter="getDescription", setter="setDescription")
     * @SerializedName("description")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getDescription", setter: "setDescription")]
    #[SerializedName("description")]
    #[Type("string")]
    #[XmlAttribute]
    private $description;

    /**
     * Zimlet extension
     *
     * @Accessor(getter="getExtension", setter="setExtension")
     * @SerializedName("extension")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getExtension", setter: "setExtension")]
    #[SerializedName("extension")]
    #[Type("string")]
    #[XmlAttribute]
    private $extension;

    /**
     * Zimlet target
     *
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getTarget", setter: "setTarget")]
    #[SerializedName("target")]
    #[Type("string")]
    #[XmlAttribute]
    private $target;

    /**
     * Zimlet label
     *
     * @Accessor(getter="getLabel", setter="setLabel")
     * @SerializedName("label")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getLabel", setter: "setLabel")]
    #[SerializedName("label")]
    #[Type("string")]
    #[XmlAttribute]
    private $label;

    /**
     * Zimlet global configuration information
     *
     * @Accessor(getter="getGlobal", setter="setGlobal")
     * @SerializedName("global")
     * @Type("Zimbra\Admin\Struct\AdminZimletGlobalConfigInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var ZimletGlobalConfigInfo
     */
    #[Accessor(getter: "getGlobal", setter: "setGlobal")]
    #[SerializedName("global")]
    #[Type(AdminZimletGlobalConfigInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?ZimletGlobalConfigInfo $global = null;

    /**
     * Zimlet host configuration information
     *
     * @Accessor(getter="getHost", setter="setHost")
     * @SerializedName("host")
     * @Type("Zimbra\Admin\Struct\AdminZimletHostConfigInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var ZimletHostConfigInfo
     */
    #[Accessor(getter: "getHost", setter: "setHost")]
    #[SerializedName("host")]
    #[Type(AdminZimletHostConfigInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?ZimletHostConfigInfo $host = null;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $version
     * @param string $description
     * @param string $extension
     * @param string $target
     * @param string $label
     * @return self
     */
    public function __construct(
        ?string $name = null,
        ?string $version = null,
        ?string $description = null,
        ?string $extension = null,
        ?string $target = null,
        ?string $label = null
    ) {
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $version) {
            $this->setVersion($version);
        }
        if (null !== $description) {
            $this->setDescription($description);
        }
        if (null !== $extension) {
            $this->setExtension($extension);
        }
        if (null !== $target) {
            $this->setTarget($target);
        }
        if (null !== $label) {
            $this->setLabel($label);
        }
    }

    /**
     * Get zimlet name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set zimlet name
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
     * Get zimlet version
     *
     * @return string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * Set zimlet version
     *
     * @param  string $version
     * @return self
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Get zimlet description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set zimlet description
     *
     * @param  string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get zimlet extension
     *
     * @return string
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * Set zimlet extension
     *
     * @param  string $extension
     * @return self
     */
    public function setExtension(string $extension): self
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * Get zimlet target
     *
     * @return string
     */
    public function getTarget(): ?string
    {
        return $this->target;
    }

    /**
     * Set zimlet target
     *
     * @param  string $target
     * @return self
     */
    public function setTarget(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Get zimlet label
     *
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Set zimlet label
     *
     * @param  string $label
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Get Zimlet global configuration information
     *
     * @return ZimletGlobalConfigInfo
     */
    public function getGlobal(): ?ZimletGlobalConfigInfo
    {
        return $this->global;
    }

    /**
     * Set Zimlet global configuration information
     *
     * @param  ZimletGlobalConfigInfo $global
     * @return self
     */
    public function setGlobal(ZimletGlobalConfigInfo $global): self
    {
        if ($global instanceof AdminZimletGlobalConfigInfo) {
            $this->global = $global;
        }
        return $this;
    }

    /**
     * Get Zimlet host configuration information
     *
     * @return ZimletHostConfigInfo
     */
    public function getHost(): ?ZimletHostConfigInfo
    {
        return $this->host;
    }

    /**
     * Set Zimlet host configuration information
     *
     * @param  ZimletHostConfigInfo $host
     * @return self
     */
    public function setHost(ZimletHostConfigInfo $host): self
    {
        if ($host instanceof AdminZimletHostConfigInfo) {
            $this->host = $host;
        }
        return $this;
    }
}
