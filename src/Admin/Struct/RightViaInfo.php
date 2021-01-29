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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};

/**
 * RightViaInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="via")
 */
class RightViaInfo
{
    /**
     * Target
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\TargetWithType")
     * @XmlElement
     */
    private $target;

    /**
     * Target
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeWithType")
     * @XmlElement
     */
    private $grantee;

    /**
     * Target
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Admin\Struct\CheckedRight")
     * @XmlElement
     */
    private $right;

    /**
     * Constructor method for RightViaInfo
     * @param string $value
     * @return self
     */
    public function __construct(TargetWithType $target, GranteeWithType $grantee, CheckedRight $right)
    {
        $this->setTarget($target)
             ->setGrantee($grantee)
             ->setRight($right);
    }

    /**
     * Gets target
     *
     * @return TargetWithType
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Sets target
     *
     * @param  TargetWithType $query
     * @return self
     */
    public function setTarget(TargetWithType $target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Gets grantee
     *
     * @return GranteeWithType
     */
    public function getGrantee()
    {
        return $this->grantee;
    }

    /**
     * Sets grantee
     *
     * @param  GranteeWithType $query
     * @return self
     */
    public function setGrantee(GranteeWithType $grantee)
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Gets right
     *
     * @return CheckedRight
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Sets right
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
