<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\ZimletDesc;

/**
 * AccountZimletDesc class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AccountZimletDesc implements ZimletDesc
{
    /**
     * Zimlet name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Zimlet version
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("version")
     * @Type("string")
     * @XmlAttribute
     */
    private $version;

    /**
     * Zimlet description
     * @Accessor(getter="getDescription", setter="setDescription")
     * @SerializedName("description")
     * @Type("string")
     * @XmlAttribute
     */
    private $description;

    /**
     * Zimlet extension
     * @Accessor(getter="getExtension", setter="setExtension")
     * @SerializedName("extension")
     * @Type("string")
     * @XmlAttribute
     */
    private $extension;

    /**
     * Zimlet target
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("string")
     * @XmlAttribute
     */
    private $target;

    /**
     * Zimlet label
     * @Accessor(getter="getLabel", setter="setLabel")
     * @SerializedName("label")
     * @Type("string")
     * @XmlAttribute
     */
    private $label;

    /**
     * @Accessor(getter="getServerExtension", setter="setServerExtension")
     * @SerializedName("serverExtension")
     * @Type("Zimbra\Account\Struct\ZimletServerExtension")
     * @XmlElement
     */
    private ?ZimletServerExtension $serverExtension = NULL;

    /**
     * @Accessor(getter="getZimletInclude", setter="setZimletInclude")
     * @SerializedName("include")
     * @Type("Zimbra\Account\Struct\AccountZimletInclude")
     * @XmlElement
     */
    private ?AccountZimletInclude $include = NULL;

    /**
     * @Accessor(getter="getZimletIncludeCSS", setter="setZimletIncludeCSS")
     * @SerializedName("includeCSS")
     * @Type("Zimbra\Account\Struct\AccountZimletIncludeCSS")
     * @XmlElement
     */
    private ?AccountZimletIncludeCSS $includeCSS = NULL;

    /**
     * @Accessor(getter="getZimletTarget", setter="setZimletTarget")
     * @SerializedName("zimletTarget")
     * @Type("Zimbra\Account\Struct\AccountZimletTarget")
     * @XmlElement
     */
    private ?AccountZimletTarget $zimletTarget = NULL;

    /**
     * Constructor method for AccountZimletDesc
     * @param string $name
     * @param string $version
     * @param string $description
     * @param string $extension
     * @param string $target
     * @param string $label
     * @return self
     */
    public function __construct(
        ?string $name = NULL,
        ?string $version = NULL,
        ?string $description = NULL,
        ?string $extension = NULL,
        ?string $target = NULL,
        ?string $label = NULL
    )
    {
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $version) {
            $this->setVersion($version);
        }
        if (NULL !== $description) {
            $this->setDescription($description);
        }
        if (NULL !== $extension) {
            $this->setExtension($extension);
        }
        if (NULL !== $target) {
            $this->setTarget($target);
        }
        if (NULL !== $label) {
            $this->setLabel($label);
        }
    }

    /**
     * Gets zimlet name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets zimlet name
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
     * Gets zimlet version
     *
     * @return string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * Sets zimlet version
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
     * Gets zimlet description
     *
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets zimlet description
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
     * Gets zimlet extension
     *
     * @return string
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * Sets zimlet extension
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
     * Gets zimlet target
     *
     * @return string
     */
    public function getTarget(): ?string
    {
        return $this->target;
    }

    /**
     * Sets zimlet target
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
     * Gets zimlet label
     *
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Sets zimlet label
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
     * Gets zimlet server extension
     *
     * @return ZimletServerExtension
     */
    public function getServerExtension(): ?ZimletServerExtension
    {
        return $this->serverExtension;
    }

    /**
     * Sets zimlet server extension
     *
     * @param  ZimletServerExtension $serverExtension
     * @return self
     */
    public function setServerExtension(ZimletServerExtension $serverExtension): self
    {
        $this->serverExtension = $serverExtension;
        return $this;
    }

    /**
     * Gets zimlet include
     *
     * @return AccountZimletInclude
     */
    public function getZimletInclude(): ?AccountZimletInclude
    {
        return $this->include;
    }

    /**
     * Sets zimlet include
     *
     * @param  AccountZimletInclude $include
     * @return self
     */
    public function setZimletInclude(AccountZimletInclude $include): self
    {
        $this->include = $include;
        return $this;
    }

    /**
     * Gets zimlet include CSS
     *
     * @return AccountZimletIncludeCSS
     */
    public function getZimletIncludeCSS(): ?AccountZimletIncludeCSS
    {
        return $this->includeCSS;
    }

    /**
     * Sets zimlet include CSS
     *
     * @param  AccountZimletIncludeCSS $includeCSS
     * @return self
     */
    public function setZimletIncludeCSS(AccountZimletIncludeCSS $includeCSS): self
    {
        $this->includeCSS = $includeCSS;
        return $this;
    }

    /**
     * Gets zimlet target
     *
     * @return AccountZimletTarget
     */
    public function getZimletTarget(): ?AccountZimletTarget
    {
        return $this->zimletTarget;
    }

    /**
     * Sets zimlet target
     *
     * @param  AccountZimletTarget $zimletTarget
     * @return self
     */
    public function setZimletTarget(AccountZimletTarget $zimletTarget): self
    {
        $this->zimletTarget = $zimletTarget;
        return $this;
    }
}
