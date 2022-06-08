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
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * GrantRight request class
 * Grant a right on a target to an individual or group grantee.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GrantRightRequest extends Request
{
    /**
     * Target selector
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsTargetSelector")
     * @XmlElement
     */
    private EffectiveRightsTargetSelector $target;

    /**
     * Grantee selector
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeSelector")
     * @XmlElement
     */
    private GranteeSelector $grantee;

    /**
     * Checked Right
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Admin\Struct\RightModifierInfo")
     * @XmlElement
     */
    private RightModifierInfo $right;

    /**
     * Constructor method for GrantRightRequest
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
     * Gets target
     *
     * @return EffectiveRightsTargetSelector
     */
    public function getTarget(): EffectiveRightsTargetSelector
    {
        return $this->target;
    }

    /**
     * Sets target
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
     * Gets grantee
     *
     * @return GranteeSelector
     */
    public function getGrantee(): GranteeSelector
    {
        return $this->grantee;
    }

    /**
     * Sets grantee
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

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GrantRightEnvelope(
            new GrantRightBody($this)
        );
    }
}
