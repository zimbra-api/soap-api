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
 * RestoreContactsBody class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RestoreContactsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("RestoreContactsRequest")
     * @Type("Zimbra\Mail\Message\RestoreContactsRequest")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var SoapRequestInterface
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName('RestoreContactsRequest')]
    #[Type(RestoreContactsRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("RestoreContactsResponse")
     * @Type("Zimbra\Mail\Message\RestoreContactsResponse")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var SoapResponseInterface
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName('RestoreContactsResponse')]
    #[Type(RestoreContactsResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor
     *
     * @param  RestoreContactsRequest $request
     * @param  RestoreContactsResponse $response
     * @return self
     */
    public function __construct(
        ?RestoreContactsRequest $request = NULL, ?RestoreContactsResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof RestoreContactsRequest) {
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
        if ($response instanceof RestoreContactsResponse) {
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
