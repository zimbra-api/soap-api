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
 * CreateSystemRetentionPolicyRequest class
 * Create a system retention policy.
 * The system retention policy SOAP APIs allow the administrator to edit named system retention policies that users
 * can apply to folders and tags.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateSystemRetentionPolicyRequest")
 */
class CreateSystemRetentionPolicyRequest extends Request
{
    /**
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement
     */
    private $cos;

    /**
     * @Accessor(getter="getKeepPolicy", setter="setKeepPolicy")
     * @SerializedName("keep")
     * @Type("Zimbra\Admin\Struct\PolicyHolder")
     * @XmlElement
     */
    private $keep;

    /**
     * @Accessor(getter="getPurgePolicy", setter="setPurgePolicy")
     * @SerializedName("purge")
     * @Type("Zimbra\Admin\Struct\PolicyHolder")
     * @XmlElement
     */
    private $purge;

    /**
     * Constructor method for CreateSystemRetentionPolicyRequest
     * 
     * @param  CosSelector  $cos
     * @param  PolicyHolder $keep
     * @param  PolicyHolder $purge
     * @return self
     */
    public function __construct(?CosSelector $cos = NULL, ?PolicyHolder $keep = NULL, ?PolicyHolder $purge = NULL)
    {
        if ($cos instanceof CosSelector) {
            $this->setCos($cos);
        }
        if ($keep instanceof PolicyHolder) {
            $this->setKeepPolicy($keep);
        }
        if ($purge instanceof PolicyHolder) {
            $this->setPurgePolicy($purge);
        }
    }

    public static function newKeepRequest(Policy $policy): CreateSystemRetentionPolicyRequest
    {
        return new self(NULL, new PolicyHolder($policy));
    }

    public static function newPurgeRequest(Policy $policy): CreateSystemRetentionPolicyRequest
    {
        return new self(NULL, NULL, new PolicyHolder($policy));
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
     * Gets keep policy
     *
     * @return PolicyHolder
     */
    public function getKeepPolicy(): ?PolicyHolder
    {
        return $this->keep;
    }

    /**
     * Sets keep policy
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
     * Gets purge policy
     *
     * @return PolicyHolder
     */
    public function getPurgePolicy(): ?PolicyHolder
    {
        return $this->purge;
    }

    /**
     * Sets purge policy
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CreateSystemRetentionPolicyEnvelope)) {
            $this->envelope = new CreateSystemRetentionPolicyEnvelope(
                new CreateSystemRetentionPolicyBody($this)
            );
        }
    }
}
