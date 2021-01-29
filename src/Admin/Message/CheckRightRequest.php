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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait, CheckedRight, EffectiveRightsTargetSelector, GranteeSelector};
use Zimbra\Soap\Request;

/**
 * CheckRight request class
 * Check if a principal has the specified right on target.
 * A successful return means the principal specified by the <grantee> is allowed for the specified right on the target object. 
 * If PERM_DENIED is thrown, it means the authed user does not have privilege to run this SOAP command (has to be an admin because this command is in admin namespace). 
 * Result of CheckRightRequest is in the allow="1|0" attribute in CheckRightResponse. If a specific grant decisively lead to the result, details of it are specified in <via> in the <CheckRightResponse>.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckRightRequest")
 */
class CheckRightRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Target
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsTargetSelector")
     * @XmlElement
     */
    private $target;

    /**
     * Grantee - valid values for type are "usr" and "email"
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeSelector")
     * @XmlElement
     */
    private $grantee;

    /**
     * Checked Right
     * @Accessor(getter="getRight", setter="setRight")
     * @SerializedName("right")
     * @Type("Zimbra\Admin\Struct\CheckedRight")
     * @XmlElement
     */
    private $right;

    /**
     * Constructor method for CheckRightRequest
     * 
     * @param EffectiveRightsTargetSelector $target
     * @param GranteeSelector $grantee
     * @param CheckedRight $right
     * @param array $attrs
     * @return self
     */
    public function __construct(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        CheckedRight $right,
        array $attrs = []
    )
    {
        $this->setTarget($target)
             ->setGrantee($grantee)
             ->setRight($right)
             ->setAttrs($attrs);
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
     * @return CheckedRight
     */
    public function getRight(): CheckedRight
    {
        return $this->right;
    }

    /**
     * Sets right
     *
     * @param  CheckedRight $right
     * @return self
     */
    public function setRight(CheckedRight $right): self
    {
        $this->right = $right;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CheckRightEnvelope)) {
            $this->envelope = new CheckRightEnvelope(
                new CheckRightBody($this)
            );
        }
    }
}
