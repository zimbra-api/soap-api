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
 * BeginTrackingIMAPBody class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class BeginTrackingIMAPBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("BeginTrackingIMAPRequest")
     * @Type("Zimbra\Mail\Message\BeginTrackingIMAPRequest")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var BeginTrackingIMAPRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName('BeginTrackingIMAPRequest')]
    #[Type(BeginTrackingIMAPRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("BeginTrackingIMAPResponse")
     * @Type("Zimbra\Mail\Message\BeginTrackingIMAPResponse")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var BeginTrackingIMAPResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName('BeginTrackingIMAPResponse')]
    #[Type(BeginTrackingIMAPResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $response;

    /**
     * Constructor
     *
     * @param  BeginTrackingIMAPRequest $request
     * @param  BeginTrackingIMAPResponse $response
     * @return self
     */
    public function __construct(
        ?BeginTrackingIMAPRequest $request = NULL, ?BeginTrackingIMAPResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof BeginTrackingIMAPRequest) {
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
        if ($response instanceof BeginTrackingIMAPResponse) {
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
