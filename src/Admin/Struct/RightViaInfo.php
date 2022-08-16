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
     * @var TargetWithType
     */
    #[Accessor(getter: 'getTarget', setter: 'setTarget')]
    #[SerializedName(name: 'target')]
    #[Type(name: TargetWithType::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $target;

    /**
     * Target
     * 
     * @var GranteeWithType
     */
    #[Accessor(getter: 'getGrantee', setter: 'setGrantee')]
    #[SerializedName(name: 'grantee')]
    #[Type(name: GranteeWithType::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $grantee;

    /**
     * Target
     * 
     * @var CheckedRight
     */
    #[Accessor(getter: 'getRight', setter: 'setRight')]
    #[SerializedName(name: 'right')]
    #[Type(name: CheckedRight::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $right;

    /**
     * Constructor
     * 
     * @param TargetWithType $target
     * @param GranteeWithType $grantee
     * @param CheckedRight $right
     * @return self
     */
    public function __construct(
        TargetWithType $target, GranteeWithType $grantee, CheckedRight $right
    )
    {
        $this->setTarget($target)
             ->setGrantee($grantee)
             ->setRight($right);
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
