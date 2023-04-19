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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace};

/**
 * Soap envelope class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
#[XmlNamespace(uri: SoapEnvelope::SOAP_NAMESPACE, prefix: 'soap')]
abstract class SoapEnvelope implements SoapEnvelopeInterface
{
    const SOAP_NAMESPACE = 'http://www.w3.org/2003/05/soap-envelope';

    /**
     * Header
     * 
     * @var SoapHeaderInterface
     */
    #[Accessor(getter: 'getHeader', setter: 'setHeader')]
    #[SerializedName('Header')]
    #[Type(SoapHeader::class)]
    #[XmlElement(namespace: SoapEnvelope::SOAP_NAMESPACE)]
    private ?SoapHeaderInterface $header;

    /**
     * Constructor
     * 
     * @param  SoapBodyInterface $body
     * @param  SoapHeaderInterface $header
     * @return self
     */
    public function __construct(?SoapBodyInterface $body = NULL, ?SoapHeaderInterface $header = NULL)
    {
        $this->header = $header;
        if ($body instanceof SoapBodyInterface) {
            $this->setBody($body);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader(): ?SoapHeaderInterface
    {
        return $this->header;
    }

    /**
     * Set soap header message
     *
     * @param  SoapHeaderInterface $header
     * @return self
     */
    public function setHeader(SoapHeaderInterface $header): self
    {
        $this->header = $header;
        return $this;
    }
}
