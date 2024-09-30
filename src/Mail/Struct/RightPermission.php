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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};

/**
 * RightPermission class
 * Individual right information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RightPermission
{
    /**
     * If set then the authed user has the right {right-name} on the target.
     *
     * @Accessor(getter="getAllow", setter="setAllow")
     * @SerializedName("allow")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getAllow", setter: "setAllow")]
    #[SerializedName("allow")]
    #[Type("bool")]
    #[XmlAttribute]
    private $allow;

    /**
     * Right name
     *
     * @Accessor(getter="getRightName", setter="setRightName")
     * @Type("string")
     * @XmlValue(cdata=false)
     *
     * @var string
     */
    #[Accessor(getter: "getRightName", setter: "setRightName")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $rightName;

    /**
     * Constructor
     *
     * @param  bool $allow
     * @param  string $rightName
     * @return self
     */
    public function __construct(bool $allow = false, ?string $rightName = null)
    {
        $this->setAllow($allow);
        if (null !== $rightName) {
            $this->setRightName($rightName);
        }
    }

    /**
     * Get allow
     *
     * @return bool
     */
    public function getAllow(): bool
    {
        return $this->allow;
    }

    /**
     * Set allow
     *
     * @param  bool $allow
     * @return self
     */
    public function setAllow(bool $allow): self
    {
        $this->allow = $allow;
        return $this;
    }

    /**
     * Get rightName
     *
     * @return string
     */
    public function getRightName(): ?string
    {
        return $this->rightName;
    }

    /**
     * Set rightName
     *
     * @param  string $rightName
     * @return self
     */
    public function setRightName(string $rightName): self
    {
        $this->rightName = $rightName;
        return $this;
    }
}
