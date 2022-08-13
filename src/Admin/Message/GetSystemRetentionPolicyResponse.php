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
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetSystemRetentionPolicyResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetSystemRetentionPolicyResponse extends SoapResponse
{
    /**
     * Retention Policy information
     * 
     * @Accessor(getter="getRetentionPolicy", setter="setRetentionPolicy")
     * @SerializedName("retentionPolicy")
     * @Type("Zimbra\Mail\Struct\RetentionPolicy")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var RetentionPolicy
     */
    #[Accessor(getter: 'getRetentionPolicy', setter: 'setRetentionPolicy')]
    #[SerializedName(name: 'retentionPolicy')]
    #[Type(name: RetentionPolicy::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $retentionPolicy;

    /**
     * Constructor
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function __construct(?RetentionPolicy $retentionPolicy = NULL)
    {
        if ($retentionPolicy instanceof RetentionPolicy) {
            $this->setRetentionPolicy($retentionPolicy);
        }
    }

    /**
     * Get retentionPolicy
     *
     * @return RetentionPolicy
     */
    public function getRetentionPolicy(): ?RetentionPolicy
    {
        return $this->retentionPolicy;
    }

    /**
     * Set retentionPolicy
     *
     * @param  RetentionPolicy $retentionPolicy
     * @return self
     */
    public function setRetentionPolicy(RetentionPolicy $retentionPolicy): self
    {
        $this->retentionPolicy = $retentionPolicy;
        return $this;
    }
}
