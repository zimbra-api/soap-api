<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{SoapBody, SoapRequestInterface, SoapResponseInterface};

/**
 * CounterAppointmentBody class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CounterAppointmentBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("CounterAppointmentRequest")
     * @Type("Zimbra\Mail\Message\CounterAppointmentRequest")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("CounterAppointmentResponse")
     * @Type("Zimbra\Mail\Message\CounterAppointmentResponse")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor
     *
     * @param  CounterAppointmentRequest $request
     * @param  CounterAppointmentResponse $response
     * @return self
     */
    public function __construct(
        ?CounterAppointmentRequest $request = NULL, ?CounterAppointmentResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof CounterAppointmentRequest) {
            $this->request = $request;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest(): ?SoapRequestInterface
    {
        return $this->request;
    }

    /**
     * {@inheritdoc}
     */
    public function setResponse(SoapResponseInterface $response): self
    {
        if ($response instanceof CounterAppointmentResponse) {
            $this->response = $response;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse(): ?SoapResponseInterface
    {
        return $this->response;
    }
}
