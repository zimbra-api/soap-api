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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};

/**
 * RightModifierInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="right")
 */
class RightModifierInfo
{
    /**
     * Value is of the form
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Deny flag - default is 0 (false)
     * @Accessor(getter="getDeny", setter="setDeny")
     * @SerializedName("deny")
     * @Type("bool")
     * @XmlAttribute
     */
    private $deny;

    /**
     * Flag whether can delegate - default is 0 (false)
     * @Accessor(getter="getCanDelegate", setter="setCanDelegate")
     * @SerializedName("canDelegate")
     * @Type("bool")
     * @XmlAttribute
     */
    private $canDelegate;

    /**
     * disinheritSubGroups flag - default is 0 (false)
     * @Accessor(getter="getDisinheritSubGroups", setter="setDisinheritSubGroups")
     * @SerializedName("disinheritSubGroups")
     * @Type("bool")
     * @XmlAttribute
     */
    private $disinheritSubGroups;

    /**
     * subDomain flag - default is 0 (false)
     * @Accessor(getter="getSubDomain", setter="setSubDomain")
     * @SerializedName("subDomain")
     * @Type("bool")
     * @XmlAttribute
     */
    private $subDomain;

    /**
     * Constructor method for RightModifierInfo
     * @param string $value
     * @param bool $deny
     * @param bool $canDelegate
     * @param bool $disinheritSubGroups
     * @param bool $subDomain
     * @return self
     */
    public function __construct(
        ?string $value = NULL,
        ?bool $deny = NULL,
        ?bool $canDelegate = NULL,
        ?bool $disinheritSubGroups = NULL,
        ?bool $subDomain = NULL
    )
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if (NULL !== $deny) {
            $this->setDeny($deny);
        }
        if (NULL !== $canDelegate) {
            $this->setCanDelegate($canDelegate);
        }
        if (NULL !== $disinheritSubGroups) {
            $this->setDisinheritSubGroups($disinheritSubGroups);
        }
        if (NULL !== $subDomain) {
            $this->setSubDomain($subDomain);
        }
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets value
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
     * Gets the deny flag
     *
     * @return bool
     */
    public function getDeny(): ?bool
    {
        return $this->deny;
    }

    /**
     * Sets the deny flag
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
     * Gets the can delegate flag
     *
     * @return bool
     */
    public function getCanDelegate(): ?bool
    {
        return $this->canDelegate;
    }

    /**
     * Sets the can delegate flag
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
     * Gets the disinheritSubGroups flag
     *
     * @return bool
     */
    public function getDisinheritSubGroups(): ?bool
    {
        return $this->disinheritSubGroups;
    }

    /**
     * Sets the disinheritSubGroups flag
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
     * Gets the sub domain flag
     *
     * @return bool
     */
    public function getSubDomain(): ?bool
    {
        return $this->subDomain;
    }

    /**
     * Sets the sub domain flag
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
