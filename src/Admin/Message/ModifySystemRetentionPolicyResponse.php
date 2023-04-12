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
use Zimbra\Mail\Struct\Policy;
use Zimbra\Common\Struct\SoapResponse;

/**
 * ModifySystemRetentionPolicyResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifySystemRetentionPolicyResponse extends SoapResponse
{
    /**
     * Information about retention policy
     * 
     * @var Policy
     */
    #[Accessor(getter: 'getPolicy', setter: 'setPolicy')]
    #[SerializedName('policy')]
    #[Type(Policy::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?Policy $policy;

    /**
     * Constructor
     *
     * @param  Policy $policy
     * @return self
     */
    public function __construct(?Policy $policy = NULL)
    {
        $this->policy = $policy;
    }

    /**
     * Get policy
     *
     * @return Policy
     */
    public function getPolicy(): ?Policy
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
}
