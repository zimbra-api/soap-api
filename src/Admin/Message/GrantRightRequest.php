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
 * GrantRight request class
 * Grant a right on a target to an individual or group grantee.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GrantRightRequest extends SoapRequest
{
    /**
     * Target selector
     * 
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsTargetSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var EffectiveRightsTargetSelector
     */
    private $target;

    /**
     * Grantee selector
     * 
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var GranteeSelector
     */
    private $grantee;

    /**
     * Checked Right
     * 
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Admin\Struct\RightModifierInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var RightModifierInfo
     */
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
        return new GrantRightEnvelope(
            new GrantRightBody($this)
        );
    }
}
