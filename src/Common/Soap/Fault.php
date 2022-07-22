<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * Soap fault class
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Fault
{
    /**
     * Fault code
     * 
     * @Accessor(getter="getCode", setter="setCode")
     * @SerializedName("Code")
     * @Type("Zimbra\Common\Soap\Fault\Code")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     * @var Code
     */
    private ?Code $code = NULL;

    /**
     * Fault reason
     * 
     * @Accessor(getter="getReason", setter="setReason")
     * @SerializedName("Reason")
     * @Type("Zimbra\Common\Soap\Fault\Reason")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     * @var Reason
     */
    private ?Reason $reason = NULL;

    /**
     * Constructor
     * 
     * @param  Code $code
     * @param  Reason $reason
     * @return self
     */
    public function __construct(
        ?Code $code = NULL, ?Reason $reason = NULL
    )
    {
        if ($code instanceof RequestInterface) {
            $this->setCode($Code);
        }
        if ($reason instanceof Reason) {
            $this->setReason($reason);
        }
    }

    /**
     * Set the fault code.
     *
     * @param Code $code
     * @return self
     */
    public function setCode(Code $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get the fault code.
     *
     * @return Code
     */
    public function getCode(): ?Code
    {
        return $this->code;
    }

    /**
     * Set the fault reason.
     *
     * @param Reason $reason
     * @return self
     */
    public function setReason(Reason $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * Get the fault reason.
     *
     * @return Code
     */
    public function getReason(): ?Reason
    {
        return $this->reason;
    }
}
