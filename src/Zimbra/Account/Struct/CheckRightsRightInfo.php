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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot, XmlValue};

/**
 * CheckRightsRightInfo struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="right")
 */
class CheckRightsRightInfo
{
    /**
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $right;

    /**
     * @Accessor(getter="getAllow", setter="setAllow")
     * @SerializedName("allow")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allow;

    /**
     * Constructor method for CheckRightsRightInfo
     * @param  string $right name of right
     * @param  bool   $allow flags whether the authed user has the right on the target
     * @return self
     */
    public function __construct($right, $allow)
    {
        $this->setRight($right)
            ->setAllow($allow);
    }

    /**
     * Gets name of right
     *
     * @return string
     */
    public function getRight(): string
    {
        return $this->right;
    }

    /**
     * Sets name of right
     *
     * @param  string $right
     * @return self
     */
    public function setRight($right): self
    {
        $this->right = trim($right);
        return $this;
    }

    /**
     * Gets flags whether the authed user has the right on the target
     *
     * @return bool
     */
    public function getAllow(): bool
    {
        return $this->allow;
    }

    /**
     * Sets flags whether the authed user has the right on the target
     *
     * @param  bool $allow
     * @return self
     */
    public function setAllow($allow): self
    {
        $this->allow = (bool) $allow;
        return $this;
    }
}
