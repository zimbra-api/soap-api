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
 * AnnounceOrganizerChangeBody class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AnnounceOrganizerChangeBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("AnnounceOrganizerChangeRequest")
     * @Type("Zimbra\Mail\Message\AnnounceOrganizerChangeRequest")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var AnnounceOrganizerChangeRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName('AnnounceOrganizerChangeRequest')]
    #[Type(AnnounceOrganizerChangeRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("AnnounceOrganizerChangeResponse")
     * @Type("Zimbra\Mail\Message\AnnounceOrganizerChangeResponse")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var AnnounceOrganizerChangeResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName('AnnounceOrganizerChangeResponse')]
    #[Type(AnnounceOrganizerChangeResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $response;

    /**
     * Constructor
     *
     * @param  AnnounceOrganizerChangeRequest $request
     * @param  AnnounceOrganizerChangeResponse $response
     * @return self
     */
    public function __construct(
        ?AnnounceOrganizerChangeRequest $request = NULL, ?AnnounceOrganizerChangeResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof AnnounceOrganizerChangeRequest) {
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
        if ($response instanceof AnnounceOrganizerChangeResponse) {
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
