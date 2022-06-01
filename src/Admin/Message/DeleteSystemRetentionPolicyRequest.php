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
use Zimbra\Soap\Request;

/**
 * DeleteSystemRetentionPolicyRequest class
 * Delete a system retention policy.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteSystemRetentionPolicyRequest extends Request
{
    /**
     * COS
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement
     */
    private ?CosSelector $cos = NULL;

    /**
     * Details of policy
     * @Accessor(getter="getPolicy", setter="setPolicy")
     * @SerializedName("policy")
     * @Type("Zimbra\Mail\Struct\Policy")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private Policy $policy;

    /**
     * Constructor method for DeleteSystemRetentionPolicyRequest
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
     * Gets cos
     *
     * @return CosSelector
     */
    public function getCos(): ?CosSelector
    {
        return $this->cos;
    }

    /**
     * Sets cos
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
     * Gets policy
     *
     * @return Policy
     */
    public function getPolicy(): Policy
    {
        return $this->policy;
    }

    /**
     * Sets policy
     *
     * @param  Policy $id
     * @return self
     */
    public function setPolicy(Policy $policy): self
    {
        $this->policy = $policy;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof DeleteSystemRetentionPolicyEnvelope)) {
            $this->envelope = new DeleteSystemRetentionPolicyEnvelope(
                new DeleteSystemRetentionPolicyBody($this)
            );
        }
    }
}
