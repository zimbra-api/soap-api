<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\Fault\{Code, Reason};

/**
 * Soap fault class
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SoapFault implements SoapFaultInterface
{
    /**
     * Fault code
     * 
     * @var Code
     */
    #[Accessor(getter: 'getFaultCode', setter: 'setFaultCode')]
    #[SerializedName('Code')]
    #[Type(Code::class)]
    #[XmlElement(namespace: SoapEnvelope::SOAP_NAMESPACE)]
    private ?Code $faultCode;

    /**
     * Fault reason
     * 
     * @var Reason
     */
    #[Accessor(getter: 'getFaultReason', setter: 'setFaultReason')]
    #[SerializedName('Reason')]
    #[Type(Reason::class)]
    #[XmlElement(namespace: SoapEnvelope::SOAP_NAMESPACE)]
    private ?Reason $faultReason;

    /**
     * Constructor
     * 
     * @param  Code $faultCode
     * @param  Reason $faultReason
     * @return self
     */
    public function __construct(
        ?Code $faultCode = null, ?Reason $faultReason = null
    )
    {
        $this->faultCode = $faultCode;
        $this->faultReason = $faultReason;
    }

    /**
     * {@inheritdoc}
     */
    public function getFaultCode(): ?Code
    {
        return $this->faultCode;
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
     * {@inheritdoc}
     */
    public function getFaultReason(): ?Reason
    {
        return $this->faultReason;
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
     * {@inheritdoc}
     */
    public function faultCode(): ?string
    {
        return $this->faultCode->getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function faultString(): ?string
    {
        return $this->faultReason->getText();
    }
}
