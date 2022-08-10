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
 * GetAvailableSkinsBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAvailableSkinsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetAvailableSkinsRequest")
     * @Type("Zimbra\Account\Message\GetAvailableSkinsRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var GetAvailableSkinsRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'GetAvailableSkinsRequest')]
    #[Type(name: GetAvailableSkinsRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetAvailableSkinsResponse")
     * @Type("Zimbra\Account\Message\GetAvailableSkinsResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var GetAvailableSkinsResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'GetAvailableSkinsResponse')]
    #[Type(name: GetAvailableSkinsResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $response;

    /**
     * Constructor
     *
     * @param  GetAvailableSkinsRequest $request
     * @param  GetAvailableSkinsResponse $response
     * @return self
     */
    public function __construct(
        ?GetAvailableSkinsRequest $request = NULL, ?GetAvailableSkinsResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetAvailableSkinsRequest) {
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
        if ($response instanceof GetAvailableSkinsResponse) {
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
