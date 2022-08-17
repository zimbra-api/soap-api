<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{SoapBody, SoapRequestInterface, SoapResponseInterface};

/**
 * GetAccountInfoBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAccountInfoBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetAccountInfoRequest")
     * @Type("Zimbra\Admin\Message\GetAccountInfoRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var GetAccountInfoRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'GetAccountInfoRequest')]
    #[Type(name: GetAccountInfoRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetAccountInfoResponse")
     * @Type("Zimbra\Admin\Message\GetAccountInfoResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var GetAccountInfoResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'GetAccountInfoResponse')]
    #[Type(name: GetAccountInfoResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param GetAccountInfoRequest $request
     * @param GetAccountInfoResponse $response
     * @return self
     */
    public function __construct(?GetAccountInfoRequest $request = NULL, ?GetAccountInfoResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetAccountInfoRequest) {
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
        if ($response instanceof GetAccountInfoResponse) {
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
