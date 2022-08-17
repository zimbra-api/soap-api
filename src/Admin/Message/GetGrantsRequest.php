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
use Zimbra\Admin\Struct\{EffectiveRightsTargetSelector, GranteeSelector};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetGrantsRequest request class
 * Returns all grants on the specified target entry, or all grants granted to the specified grantee entry.
 * The authenticated admin must have an effective "viewGrants" (TBD) system right on the specified target/grantee.
 * At least one of <target> or <grantee> must be specified.
 * If both <target> and <grantee> are specified, only grants that are granted on the target to the grantee are returned.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetGrantsRequest extends SoapRequest
{
    /**
     * Target
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
     * Grantee
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
     * Constructor
     * 
     * @param  EffectiveRightsTargetSelector $target
     * @param  GranteeSelector $grantee
     * @return self
     */
    public function __construct(
        ?EffectiveRightsTargetSelector $target = NULL,
        ?GranteeSelector $grantee = NULL
    )
    {
        if ($target instanceof EffectiveRightsTargetSelector) {
            $this->setTarget($target);
        }
        if ($grantee instanceof GranteeSelector) {
            $this->setGrantee($grantee);
        }
    }

    /**
     * Get target.
     *
     * @return EffectiveRightsTargetSelector
     */
    public function getTarget(): ?EffectiveRightsTargetSelector
    {
        return $this->target;
    }

    /**
     * Set target.
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
     * Get grantee.
     *
     * @return GranteeSelector
     */
    public function getGrantee(): ?GranteeSelector
    {
        return $this->grantee;
    }

    /**
     * Set grantee.
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
        return new GetGrantsEnvelope(
            new GetGrantsBody($this)
        );
    }
}
