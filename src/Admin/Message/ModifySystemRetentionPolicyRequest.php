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
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifySystemRetentionPolicyRequest class
 * Modify system retention policy
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifySystemRetentionPolicyRequest extends SoapRequest
{
    /**
     * COS
     * 
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var CosSelector
     */
    #[Accessor(getter: 'getCos', setter: 'setCos')]
    #[SerializedName(name: 'cos')]
    #[Type(name: CosSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $cos;

    /**
     * New policy
     * 
     * @Accessor(getter="getPolicy", setter="setPolicy")
     * @SerializedName("policy")
     * @Type("Zimbra\Mail\Struct\Policy")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var Policy
     */
    #[Accessor(getter: 'getPolicy', setter: 'setPolicy')]
    #[SerializedName(name: 'policy')]
    #[Type(name: Policy::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $policy;

    /**
     * Constructor
     * 
     * @param  Policy $policy
     * @param  CosSelector $cos
     * @return self
     */
    public function __construct(Policy $policy, ?CosSelector $cos = NULL)
    {
        $this->setPolicy($policy);
        if ($cos instanceof CosSelector) {
            $this->setCos($cos);
        }
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
     * Get policy
     *
     * @return Policy
     */
    public function getPolicy(): Policy
    {
        return $this->policy;
    }

    /**
     * Set policy
     *
     * @param  Policy $policy
     * @return self
     */
    public function setPolicy(Policy $policy): self
    {
        $this->policy = $policy;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifySystemRetentionPolicyEnvelope(
            new ModifySystemRetentionPolicyBody($this)
        );
    }
}
