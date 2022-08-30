<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{SoapBody, SoapRequestInterface, SoapResponseInterface};

/**
 * GetSignaturesBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetSignaturesBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetSignaturesRequest")
     * @Type("Zimbra\Account\Message\GetSignaturesRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var SoapRequestInterface
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName('GetSignaturesRequest')]
    #[Type(GetSignaturesRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetSignaturesResponse")
     * @Type("Zimbra\Account\Message\GetSignaturesResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var SoapResponseInterface
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName('GetSignaturesResponse')]
    #[Type(GetSignaturesResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor
     *
     * @param  GetSignaturesRequest $request
     * @param  GetSignaturesResponse $response
     * @return self
     */
    public function __construct(
        ?GetSignaturesRequest $request = NULL, ?GetSignaturesResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetSignaturesRequest) {
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
        if ($response instanceof GetSignaturesResponse) {
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
