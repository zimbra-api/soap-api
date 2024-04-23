<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\Policy;

/**
 * PolicyHolder struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class PolicyHolder
{
    /**
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
    public function __construct(?Policy $policy = null)
    {
        $this->policy = $policy;
    }

    /**
     * Get the policy.
     *
     * @return Policy
     */
    public function getPolicy(): ?Policy
    {
        return $this->policy;
    }

    /**
     * Set the policy.
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
