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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * GrantInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GrantInfo
{
    /**
     * Information on target
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\TypeIdName")
     * @XmlElement
     */
    private $target;

    /**
     * Information on grantee
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeInfo")
     * @XmlElement
     */
    private $grantee;

    /**
     * Information on right
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Admin\Struct\RightModifierInfo")
     * @XmlElement
     */
    private $right;

    /**
     * Constructor method for GrantInfo
     * @param  TypeIdName $target
     * @param  GranteeInfo $grantee
     * @param  RightModifierInfo $right
     * @return self
     */
    public function __construct(TypeIdName $target, GranteeInfo $grantee, RightModifierInfo $right)
    {
        $this->setTarget($target)
             ->setGrantee($grantee)
             ->setRight($right);
    }

    /**
     * Gets target
     *
     * @return TypeIdName
     */
    public function getTarget(): TypeIdName
    {
        return $this->target;
    }

    /**
     * Sets target
     *
     * @param  TypeIdName $target
     * @return self
     */
    public function setTarget(TypeIdName $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Gets grantee
     *
     * @return GranteeInfo
     */
    public function getGrantee(): GranteeInfo
    {
        return $this->grantee;
    }

    /**
     * Sets grantee
     *
     * @param  GranteeInfo $grantee
     * @return self
     */
    public function setGrantee(GranteeInfo $grantee): self
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Gets right
     *
     * @return RightModifierInfo
     */
    public function getRight(): RightModifierInfo
    {
        return $this->right;
    }

    /**
     * Sets right
     *
     * @param  RightModifierInfo $right
     * @return self
     */
    public function setRight(RightModifierInfo $right): self
    {
        $this->right = $right;
        return $this;
    }
}
