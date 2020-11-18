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
use Zimbra\Admin\Struct\Policy;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateSystemRetentionPolicyResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateSystemRetentionPolicyResponse")
 */
class CreateSystemRetentionPolicyResponse implements ResponseInterface
{
    /**
     * Information about the newly created retention policy
     * @Accessor(getter="getPolicy", setter="setPolicy")
     * @SerializedName("policy")
     * @Type("Zimbra\Admin\Struct\Policy")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private $policy;

    /**
     * Constructor method for CreateSystemRetentionPolicyResponse
     * @param  Policy $policy
     * @return self
     */
    public function __construct(Policy $policy)
    {
        $this->setPolicy($policy);
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
}
