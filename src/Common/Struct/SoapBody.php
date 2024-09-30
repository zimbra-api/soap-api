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

/**
 * Soap body class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class SoapBody implements SoapBodyInterface
{
    /**
     * Soap fault
     *
     * @Accessor(getter="getSoapFault", setter="setSoapFault")
     * @SerializedName("Fault")
     * @Type("Zimbra\Common\Struct\SoapFault")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     *
     * @var SoapFaultInterface
     */
    #[Accessor(getter: "getSoapFault", setter: "setSoapFault")]
    #[SerializedName("Fault")]
    #[Type(SoapFault::class)]
    #[XmlElement(namespace: "http://www.w3.org/2003/05/soap-envelope")]
    private ?SoapFaultInterface $soapFault;

    /**
     * Constructor
     *
     * @param  SoapRequestInterface $request
     * @param  SoapResponseInterface $response
     * @param  SoapFaultInterface $soapFault
     * @return self
     */
    public function __construct(
        ?SoapRequestInterface $request = null,
        ?SoapResponseInterface $response = null,
        ?SoapFaultInterface $soapFault = null
    ) {
        $this->soapFault = $soapFault;
        if ($request instanceof SoapRequestInterface) {
            $this->setRequest($request);
        }
        if ($response instanceof SoapResponseInterface) {
            $this->setResponse($response);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSoapFault(): ?SoapFaultInterface
    {
        return $this->soapFault;
    }

    /**
     * Set the soap fault
     *
     * @param  SoapFaultInterface $soapFault
     * @return self
     */
    public function setSoapFault(SoapFaultInterface $soapFault): self
    {
        $this->soapFault = $soapFault;
        return $this;
    }

    /**
     * Set the soap request message.
     *
     * @param  SoapRequestInterface $request
     * @return self
     */
    abstract public function setRequest(SoapRequestInterface $request): self;

    /**
     * Set the soap response message.
     *
     * @param  SoapResponseInterface $response
     * @return self
     */
    abstract public function setResponse(SoapResponseInterface $response): self;
}
