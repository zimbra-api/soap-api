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
use Zimbra\Admin\Struct\{CosSelector, Policy, PolicyHolder};
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
 * @AccessType("public_method")
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 * @XmlRoot(name="DeleteSystemRetentionPolicyRequest")
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
    private $cos;

    /**
     * Details of policy
     * @Accessor(getter="getPolicy", setter="setPolicy")
     * @SerializedName("policy")
     * @Type("Zimbra\Admin\Struct\Policy")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private $policy;

    /**
     * Constructor method for DeleteSystemRetentionPolicyRequest
     * @param  Policy $policy
     * @param  CosSelector $cos
     * @return self
     */
    public function __construct(Policy $policy, CosSelector $cos = NULL)
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
    public function getCos(): CosSelector
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

    protected function internalInit()
    {
        $this->envelope = new DeleteSystemRetentionPolicyEnvelope(
            NULL,
            new DeleteSystemRetentionPolicyBody($this)
        );
    }
}
