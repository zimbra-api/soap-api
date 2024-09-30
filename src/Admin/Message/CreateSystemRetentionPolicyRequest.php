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
use Zimbra\Admin\Struct\{CosSelector, PolicyHolder};
use Zimbra\Mail\Struct\Policy;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CreateSystemRetentionPolicyRequest class
 * Create a system retention policy.
 * The system retention policy SOAP APIs allow the administrator to edit named system retention policies that users
 * can apply to folders and tags.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateSystemRetentionPolicyRequest extends SoapRequest
{
    /**
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var CosSelector
     */
    #[Accessor(getter: "getCos", setter: "setCos")]
    #[SerializedName("cos")]
    #[Type(CosSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?CosSelector $cos;

    /**
     * @Accessor(getter="getKeepPolicy", setter="setKeepPolicy")
     * @SerializedName("keep")
     * @Type("Zimbra\Admin\Struct\PolicyHolder")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var PolicyHolder
     */
    #[Accessor(getter: "getKeepPolicy", setter: "setKeepPolicy")]
    #[SerializedName("keep")]
    #[Type(PolicyHolder::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?PolicyHolder $keep;

    /**
     * @Accessor(getter="getPurgePolicy", setter="setPurgePolicy")
     * @SerializedName("purge")
     * @Type("Zimbra\Admin\Struct\PolicyHolder")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var PolicyHolder
     */
    #[Accessor(getter: "getPurgePolicy", setter: "setPurgePolicy")]
    #[SerializedName("purge")]
    #[Type(PolicyHolder::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?PolicyHolder $purge;

    /**
     * Constructor
     *
     * @param  CosSelector  $cos
     * @param  PolicyHolder $keep
     * @param  PolicyHolder $purge
     * @return self
     */
    public function __construct(
        ?CosSelector $cos = null,
        ?PolicyHolder $keep = null,
        ?PolicyHolder $purge = null
    ) {
        $this->cos = $cos;
        $this->keep = $keep;
        $this->purge = $purge;
    }

    public static function newKeepRequest(
        Policy $policy
    ): CreateSystemRetentionPolicyRequest {
        return new self(null, new PolicyHolder($policy));
    }

    public static function newPurgeRequest(
        Policy $policy
    ): CreateSystemRetentionPolicyRequest {
        return new self(null, null, new PolicyHolder($policy));
    }

    /**
     * Get cos
     *
     * @return CosSelector
     */
    public function getCos(): ?CosSelector
    {
        return $this->cos;
    }

    /**
     * Set cos
     *
     * @param  CosSelector $cos
     * @return self
     */
    public function setCos(CosSelector $cos): self
    {
        $this->cos = $cos;
        return $this;
    }

    /**
     * Get keep policy
     *
     * @return PolicyHolder
     */
    public function getKeepPolicy(): ?PolicyHolder
    {
        return $this->keep;
    }

    /**
     * Set keep policy
     *
     * @param  PolicyHolder $keep
     * @return self
     */
    public function setKeepPolicy(PolicyHolder $keep): self
    {
        $this->keep = $keep;
        return $this;
    }

    /**
     * Get purge policy
     *
     * @return PolicyHolder
     */
    public function getPurgePolicy(): ?PolicyHolder
    {
        return $this->purge;
    }

    /**
     * Set purge policy
     *
     * @param  PolicyHolder $purge
     * @return self
     */
    public function setPurgePolicy(PolicyHolder $purge): self
    {
        $this->purge = $purge;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateSystemRetentionPolicyEnvelope(
            new CreateSystemRetentionPolicyBody($this)
        );
    }
}
