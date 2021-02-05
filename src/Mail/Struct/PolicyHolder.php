<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlNamespace, XmlRoot};

/**
 * PolicyHolder struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="holder")
 */
class PolicyHolder
{
    /**
     * @Accessor(getter="getPolicy", setter="setPolicy")
     * @SerializedName("policy")
     * @Type("Zimbra\Mail\Struct\Policy")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private $policy;

    /**
     * Constructor method for PolicyHolder
     * @param  Policy $policy
     * @return self
     */
    public function __construct(?Policy $policy = NULL)
    {
        if ($policy instanceof Policy) {
            $this->setPolicy($policy);
        }
    }

    /**
     * Gets the policy.
     *
     * @return Policy
     */
    public function getPolicy(): ?Policy
    {
        return $this->policy;
    }

    /**
     * Sets the policy.
     *
     * @param  Policy $policy
     * @return self
     */
    public function setPolicy(Policy $policy): self
    {
        $this->policy = $policy;
        return $this;
    }
}