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
    XmlValue
};

/**
 * RightModifierInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RightModifierInfo
{
    /**
     * Value is of the form
     *
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     *
     * @var string
     */
    #[Accessor(getter: "getValue", setter: "setValue")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Deny flag - default is 0 (false)
     *
     * @Accessor(getter="getDeny", setter="setDeny")
     * @SerializedName("deny")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getDeny", setter: "setDeny")]
    #[SerializedName("deny")]
    #[Type("bool")]
    #[XmlAttribute]
    private $deny;

    /**
     * Flag whether can delegate - default is 0 (false)
     *
     * @Accessor(getter="getCanDelegate", setter="setCanDelegate")
     * @SerializedName("canDelegate")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getCanDelegate", setter: "setCanDelegate")]
    #[SerializedName("canDelegate")]
    #[Type("bool")]
    #[XmlAttribute]
    private $canDelegate;

    /**
     * disinheritSubGroups flag - default is 0 (false)
     *
     * @Accessor(getter="getDisinheritSubGroups", setter="setDisinheritSubGroups")
     * @SerializedName("disinheritSubGroups")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "getDisinheritSubGroups",
            setter: "setDisinheritSubGroups"
        )
    ]
    #[SerializedName("disinheritSubGroups")]
    #[Type("bool")]
    #[XmlAttribute]
    private $disinheritSubGroups;

    /**
     * subDomain flag - default is 0 (false)
     *
     * @Accessor(getter="getSubDomain", setter="setSubDomain")
     * @SerializedName("subDomain")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getSubDomain", setter: "setSubDomain")]
    #[SerializedName("subDomain")]
    #[Type("bool")]
    #[XmlAttribute]
    private $subDomain;

    /**
     * Constructor
     *
     * @param string $value
     * @param bool $deny
     * @param bool $canDelegate
     * @param bool $disinheritSubGroups
     * @param bool $subDomain
     * @return self
     */
    public function __construct(
        ?string $value = null,
        ?bool $deny = null,
        ?bool $canDelegate = null,
        ?bool $disinheritSubGroups = null,
        ?bool $subDomain = null
    ) {
        if (null !== $value) {
            $this->setValue($value);
        }
        if (null !== $deny) {
            $this->setDeny($deny);
        }
        if (null !== $canDelegate) {
            $this->setCanDelegate($canDelegate);
        }
        if (null !== $disinheritSubGroups) {
            $this->setDisinheritSubGroups($disinheritSubGroups);
        }
        if (null !== $subDomain) {
            $this->setSubDomain($subDomain);
        }
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get the deny flag
     *
     * @return bool
     */
    public function getDeny(): ?bool
    {
        return $this->deny;
    }

    /**
     * Set the deny flag
     *
     * @param  bool $deny
     * @return self
     */
    public function setDeny(bool $deny): self
    {
        $this->deny = $deny;
        return $this;
    }

    /**
     * Get the can delegate flag
     *
     * @return bool
     */
    public function getCanDelegate(): ?bool
    {
        return $this->canDelegate;
    }

    /**
     * Set the can delegate flag
     *
     * @param  bool $canDelegate
     * @return self
     */
    public function setCanDelegate(bool $canDelegate): self
    {
        $this->canDelegate = $canDelegate;
        return $this;
    }

    /**
     * Get the disinheritSubGroups flag
     *
     * @return bool
     */
    public function getDisinheritSubGroups(): ?bool
    {
        return $this->disinheritSubGroups;
    }

    /**
     * Set the disinheritSubGroups flag
     *
     * @param  bool $disinheritSubGroups
     * @return self
     */
    public function setDisinheritSubGroups(bool $disinheritSubGroups): self
    {
        $this->disinheritSubGroups = $disinheritSubGroups;
        return $this;
    }

    /**
     * Get the sub domain flag
     *
     * @return bool
     */
    public function getSubDomain(): ?bool
    {
        return $this->subDomain;
    }

    /**
     * Set the sub domain flag
     *
     * @param  bool $subDomain
     * @return self
     */
    public function setSubDomain(bool $subDomain): self
    {
        $this->subDomain = $subDomain;
        return $this;
    }
}
