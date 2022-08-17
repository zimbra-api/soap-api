<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\{EffectiveRightsTargetSelector, GranteeSelector, RightModifierInfo};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * RevokeRight request class
 * Revoke a right from a target that was previously granted to an individual or group grantee.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RevokeRightRequest extends SoapRequest
{

    /**
     * Target selector
     * 
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsTargetSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var EffectiveRightsTargetSelector
     */
    #[Accessor(getter: 'getTarget', setter: 'setTarget')]
    #[SerializedName(name: 'target')]
    #[Type(name: EffectiveRightsTargetSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $target;

    /**
     * Grantee selector
     * 
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var GranteeSelector
     */
    #[Accessor(getter: 'getGrantee', setter: 'setGrantee')]
    #[SerializedName(name: 'grantee')]
    #[Type(name: GranteeSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $grantee;

    /**
     * Right
     * 
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Admin\Struct\RightModifierInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var RightModifierInfo
     */
    #[Accessor(getter: 'getRight', setter: 'setRight')]
    #[SerializedName(name: 'right')]
    #[Type(name: RightModifierInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $right;

    /**
     * Constructor
     * 
     * @param EffectiveRightsTargetSelector $target
     * @param GranteeSelector $grantee
     * @param RightModifierInfo $right
     * @return self
     */
    public function __construct(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        RightModifierInfo $right
    )
    {
        $this->setTarget($target)
             ->setGrantee($grantee)
             ->setRight($right);
    }

    /**
     * Get target
     *
     * @return EffectiveRightsTargetSelector
     */
    public function getTarget(): EffectiveRightsTargetSelector
    {
        return $this->target;
    }

    /**
     * Set target
     *
     * @param  EffectiveRightsTargetSelector $target
     * @return self
     */
    public function setTarget(EffectiveRightsTargetSelector $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Get grantee
     *
     * @return GranteeSelector
     */
    public function getGrantee(): GranteeSelector
    {
        return $this->grantee;
    }

    /**
     * Set grantee
     *
     * @param  GranteeSelector $grantee
     * @return self
     */
    public function setGrantee(GranteeSelector $grantee): self
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Get right
     *
     * @return RightModifierInfo
     */
    public function getRight(): RightModifierInfo
    {
        return $this->right;
    }

    /**
     * Set right
     *
     * @param  RightModifierInfo $right
     * @return self
     */
    public function setRight(RightModifierInfo $right): self
    {
        $this->right = $right;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new RevokeRightEnvelope(
            new RevokeRightBody($this)
        );
    }
}
