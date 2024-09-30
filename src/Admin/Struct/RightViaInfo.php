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
 * RightViaInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RightViaInfo
{
    /**
     * Target
     *
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\TargetWithType")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var TargetWithType
     */
    #[Accessor(getter: "getTarget", setter: "setTarget")]
    #[SerializedName("target")]
    #[Type(TargetWithType::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private TargetWithType $target;

    /**
     * Target
     *
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeWithType")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var GranteeWithType
     */
    #[Accessor(getter: "getGrantee", setter: "setGrantee")]
    #[SerializedName("grantee")]
    #[Type(GranteeWithType::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private GranteeWithType $grantee;

    /**
     * Target
     *
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Admin\Struct\CheckedRight")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var CheckedRight
     */
    #[Accessor(getter: "getRight", setter: "setRight")]
    #[SerializedName("right")]
    #[Type(CheckedRight::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private CheckedRight $right;

    /**
     * Constructor
     *
     * @param TargetWithType $target
     * @param GranteeWithType $grantee
     * @param CheckedRight $right
     * @return self
     */
    public function __construct(
        TargetWithType $target,
        GranteeWithType $grantee,
        CheckedRight $right
    ) {
        $this->setTarget($target)->setGrantee($grantee)->setRight($right);
    }

    /**
     * Get target
     *
     * @return TargetWithType
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set target
     *
     * @param  TargetWithType $target
     * @return self
     */
    public function setTarget(TargetWithType $target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Get grantee
     *
     * @return GranteeWithType
     */
    public function getGrantee()
    {
        return $this->grantee;
    }

    /**
     * Set grantee
     *
     * @param  GranteeWithType $grantee
     * @return self
     */
    public function setGrantee(GranteeWithType $grantee)
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Get right
     *
     * @return CheckedRight
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Set right
     *
     * @param  CheckedRight $right
     * @return self
     */
    public function setRight(CheckedRight $right)
    {
        $this->right = $right;
        return $this;
    }
}
