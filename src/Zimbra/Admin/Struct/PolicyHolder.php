<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * PolicyHolder struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 * @XmlRoot(name="holder")
 */
class PolicyHolder
{
    /**
     * @Accessor(getter="getPolicy", setter="setPolicy")
     * @SerializedName("policy")
     * @Type("Zimbra\Admin\Struct\Policy")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private $_policy;

    /**
     * Constructor method for PolicyHolder
     * @param  Policy $policy
     * @return self
     */
    public function __construct(Policy $policy = null)
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
    public function getPolicy()
    {
        return $this->_policy;
    }

    /**
     * Sets the policy.
     *
     * @param  Policy $policy
     * @return self
     */
    public function setPolicy(Policy $policy)
    {
        $this->_policy = $policy;
        return $this;
    }
}
