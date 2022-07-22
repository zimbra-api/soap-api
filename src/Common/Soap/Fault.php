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
use Zimbra\Common\Soap\Fault\{Code, Reason};

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
     * @Accessor(getter="getFaultCode", setter="setFaultCode")
     * @SerializedName("Code")
     * @Type("Zimbra\Common\Soap\Fault\Code")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     * @var Code
     */
    private ?Code $faultCode = NULL;

    /**
     * Fault reason
     * 
     * @Accessor(getter="getFaultReason", setter="setFaultReason")
     * @SerializedName("Reason")
     * @Type("Zimbra\Common\Soap\Fault\Reason")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     * @var Reason
     */
    private ?Reason $faultReason = NULL;

    /**
     * Constructor
     * 
     * @param  Code $faultCode
     * @param  Reason $faultReason
     * @return self
     */
    public function __construct(
        ?Code $faultCode = NULL, ?Reason $faultReason = NULL
    )
    {
        if ($faultCode instanceof Code) {
            $this->setFaultCode($faultCode);
        }
        if ($faultReason instanceof Reason) {
            $this->setFaultReason($faultReason);
        }
    }

    /**
     * Set the fault code.
     *
     * @param Code $faultCode
     * @return self
     */
    public function setFaultCode(Code $faultCode): self
    {
        $this->faultCode = $faultCode;
        return $this;
    }

    /**
     * Get the fault code.
     *
     * @return Code
     */
    public function getFaultCode(): ?Code
    {
        return $this->faultCode;
    }

    /**
     * Set the fault reason.
     *
     * @param Reason $faultReason
     * @return self
     */
    public function setFaultReason(Reason $faultReason): self
    {
        $this->faultReason = $faultReason;
        return $this;
    }

    /**
     * Get the fault reason.
     *
     * @return Code
     */
    public function getFaultReason(): ?Reason
    {
        return $this->faultReason;
    }
}
