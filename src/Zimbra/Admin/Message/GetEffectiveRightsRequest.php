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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector as Target;
use Zimbra\Admin\Struct\GranteeSelector as Grantee;
use Zimbra\Soap\Request;

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetEffectiveRightsRequest")
 */
class GetEffectiveRightsRequest extends Request
{
    public const EXPAND_GET_ATTRS = 'getAttrs';
    public const EXPAND_SET_ATTRS = 'setAttrs';

    /**
     * Whether to include all attribute names in the <getAttrs>/<setAttrs> elements in the response if all attributes of the target are gettable/settable Valid values are: 
     * getAttrs:    expand attrs in getAttrs in the response
     * setAttrs:     expand attrs in setAttrs in the response
     * getAttrs,setAttrs:    expand attrs in both getAttrs and setAttrs in the response 
     * @Accessor(getter="getExpandAllAttrs", setter="setExpandAllAttrs")
     * @SerializedName("expandAllAttrs")
     * @Type("string")
     * @XmlAttribute
     */
    private $expandAllAttrs;

    /**
     * Target
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsTargetSelector")
     * @XmlElement
     */
    private $target;

    /**
     * Grantee
     * If <grantee> is omitted, the account identified by the auth token is regarded as the grantee.
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeSelector")
     * @XmlElement
     */
    private $grantee;

    /**
     * Constructor method for GetEffectiveRightsRequest
     * 
     * @param  Target $target
     * @param  Grantee $grantee
     * @param  bool $expandSetAttrs
     * @param  bool $expandGetAttrs
     * @return self
     */
    public function __construct(
        Target $target, ?Grantee $grantee = NULL, ?bool $expandSetAttrs = NULL, ?bool $expandGetAttrs = NULL
    )
    {
        $this->setTarget($target);
        if ($grantee instanceof Grantee) {
            $this->setGrantee($grantee);
        }
        $attrs = [];
        if (NULL !== $expandSetAttrs) {
            $attrs[self::EXPAND_SET_ATTRS] = self::EXPAND_SET_ATTRS;
        }
        if (NULL !== $expandGetAttrs) {
            $attrs[self::EXPAND_GET_ATTRS] = self::EXPAND_GET_ATTRS;
        }
        if (!empty($attrs)) {
            $this->setExpandAllAttrs(implode(',', $attrs));
        }
    }

    /**
     * Gets expandAllAttrs
     *
     * @return string
     */
    public function getExpandAllAttrs(): string
    {
        return $this->expandAllAttrs;
    }

    /**
     * Sets expandAllAttrs
     *
     * @param  string $expandAllAttrs
     * @return self
     */
    public function setExpandAllAttrs(string $expandAllAttrs): self
    {
        $this->expandAllAttrs = '';
        $attrs = [];
        foreach (explode(',', $expandAllAttrs) as $attr) {
            if ($attr === self::EXPAND_SET_ATTRS) {
                $attrs[self::EXPAND_SET_ATTRS] = self::EXPAND_SET_ATTRS;
            }
            if ($attr === self::EXPAND_GET_ATTRS) {
                $attrs[self::EXPAND_GET_ATTRS] = self::EXPAND_GET_ATTRS;
            }
        }
        if (!empty($attrs)) {
            $this->expandAllAttrs = implode(',', $attrs);
        }
        return $this;
    }

    /**
     * Sets the target.
     *
     * @return Target
     */
    public function getTarget(): Target
    {
        return $this->target;
    }

    /**
     * Sets the target.
     *
     * @param  Target $target
     * @return self
     */
    public function setTarget(Target $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Sets the grantee.
     *
     * @return Grantee
     */
    public function getGrantee(): ?Grantee
    {
        return $this->grantee;
    }

    /**
     * Sets the grantee.
     *
     * @param  Grantee $grantee
     * @return self
     */
    public function setGrantee(Grantee $grantee): self
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetEffectiveRightsEnvelope)) {
            $this->envelope = new GetEffectiveRightsEnvelope(
                new GetEffectiveRightsBody($this)
            );
        }
    }
}
