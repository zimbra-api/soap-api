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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};

/**
 * CheckRightsRightInfo struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckRightsRightInfo
{
    /**
     * Flags whether the authed user has the right on the target
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
     * Name of right
     *
     * @Accessor(getter="getRight", setter="setRight")
     * @Type("string")
     * @XmlValue(cdata=false)
     *
     * @var string
     */
    #[Accessor(getter: "getRight", setter: "setRight")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private $right;

    /**
     * Constructor
     *
     * @param  string $right
     * @param  bool   $allow
     * @return self
     */
    public function __construct(string $right = "", bool $allow = false)
    {
        $this->setRight($right)->setAllow($allow);
    }

    /**
     * Get name of right
     *
     * @return string
     */
    public function getRight(): string
    {
        return $this->right;
    }

    /**
     * Set name of right
     *
     * @param  string $right
     * @return self
     */
    public function setRight(string $right): self
    {
        $this->right = $right;
        return $this;
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
}
