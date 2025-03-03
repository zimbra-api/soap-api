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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Admin\Struct\{EffectiveRightsTargetSelector, GranteeSelector};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetEffectiveRightsRequest request class
 * Returns effective ADMIN rights the authenticated admin has on the specified target entry.
 * Effective rights are the rights the admin is actually allowed.
 * It is the net result of applying ACL checking rules given the target and grantee.
 * Specifically denied rights will not be returned.
 * The result can help the admin console decide on what tabs to display after a target is selected.
 * For example, after user1 is selected, if the admin does not have right to setPassword, it should probably hide or gray out the setPassword tab
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetEffectiveRightsRequest extends SoapRequest
{
    const EXPAND_GET_ATTRS = "getAttrs";
    const EXPAND_SET_ATTRS = "setAttrs";

    /**
     * Whether to include all attribute names in the <getAttrs>/<setAttrs> elements in the response if all attributes of the target are gettable/settable Valid values are:
     * getAttrs:    expand attrs in getAttrs in the response
     * setAttrs:     expand attrs in setAttrs in the response
     * getAttrs,setAttrs:    expand attrs in both getAttrs and setAttrs in the response
     *
     * @var string
     */
    #[Accessor(getter: "getExpandAllAttrs", setter: "setExpandAllAttrs")]
    #[SerializedName("expandAllAttrs")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $expandAllAttrs = null;

    /**
     * Target
     *
     * @var EffectiveRightsTargetSelector
     */
    #[Accessor(getter: "getTarget", setter: "setTarget")]
    #[SerializedName("target")]
    #[Type(EffectiveRightsTargetSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private EffectiveRightsTargetSelector $target;

    /**
     * Grantee
     * If <grantee> is omitted, the account identified by the auth token is regarded as the grantee.
     *
     * @var GranteeSelector
     */
    #[Accessor(getter: "getGrantee", setter: "setGrantee")]
    #[SerializedName("grantee")]
    #[Type(GranteeSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?GranteeSelector $grantee;

    /**
     * Constructor
     *
     * @param  EffectiveRightsTargetSelector $target
     * @param  GranteeSelector $grantee
     * @param  bool $expandSetAttrs
     * @param  bool $expandGetAttrs
     * @return self
     */
    public function __construct(
        EffectiveRightsTargetSelector $target,
        ?GranteeSelector $grantee = null,
        ?bool $expandSetAttrs = null,
        ?bool $expandGetAttrs = null
    ) {
        $this->setTarget($target);
        $this->grantee = $grantee;
        $attrs = [];
        if (null !== $expandSetAttrs) {
            $attrs[self::EXPAND_SET_ATTRS] = self::EXPAND_SET_ATTRS;
        }
        if (null !== $expandGetAttrs) {
            $attrs[self::EXPAND_GET_ATTRS] = self::EXPAND_GET_ATTRS;
        }
        if (!empty($attrs)) {
            $this->setExpandAllAttrs(implode(",", $attrs));
        }
    }

    /**
     * Get expandAllAttrs
     *
     * @return string
     */
    public function getExpandAllAttrs(): ?string
    {
        return $this->expandAllAttrs;
    }

    /**
     * Set expandAllAttrs
     *
     * @param  string $expandAllAttrs
     * @return self
     */
    public function setExpandAllAttrs(string $expandAllAttrs): self
    {
        $this->expandAllAttrs = "";
        $attrs = [];
        foreach (explode(",", $expandAllAttrs) as $attr) {
            if ($attr === self::EXPAND_SET_ATTRS) {
                $attrs[self::EXPAND_SET_ATTRS] = self::EXPAND_SET_ATTRS;
            }
            if ($attr === self::EXPAND_GET_ATTRS) {
                $attrs[self::EXPAND_GET_ATTRS] = self::EXPAND_GET_ATTRS;
            }
        }
        if (!empty($attrs)) {
            $this->expandAllAttrs = implode(",", $attrs);
        }
        return $this;
    }

    /**
     * Set the target.
     *
     * @return EffectiveRightsTargetSelector
     */
    public function getTarget(): EffectiveRightsTargetSelector
    {
        return $this->target;
    }

    /**
     * Set the target.
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
     * Set the grantee.
     *
     * @return GranteeSelector
     */
    public function getGrantee(): ?GranteeSelector
    {
        return $this->grantee;
    }

    /**
     * Set the grantee.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetEffectiveRightsEnvelope(
            new GetEffectiveRightsBody($this)
        );
    }
}
