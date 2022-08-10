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
 * GetAvailableCsvFormatsBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAvailableCsvFormatsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetAvailableCsvFormatsRequest")
     * @Type("Zimbra\Account\Message\GetAvailableCsvFormatsRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var GetAvailableCsvFormatsRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'GetAvailableCsvFormatsRequest')]
    #[Type(name: GetAvailableCsvFormatsRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetAvailableCsvFormatsResponse")
     * @Type("Zimbra\Account\Message\GetAvailableCsvFormatsResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var GetAvailableCsvFormatsResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'GetAvailableCsvFormatsResponse')]
    #[Type(name: GetAvailableCsvFormatsResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $response;

    /**
     * Constructor
     *
     * @param  GetAvailableCsvFormatsRequest $request
     * @param  GetAvailableCsvFormatsResponse $response
     * @return self
     */
    public function __construct(
        ?GetAvailableCsvFormatsRequest $request = NULL, ?GetAvailableCsvFormatsResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetAvailableCsvFormatsRequest) {
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
        if ($response instanceof GetAvailableCsvFormatsResponse) {
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
