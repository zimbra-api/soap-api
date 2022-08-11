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
 * GetMemcachedClientConfigBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMemcachedClientConfigBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetMemcachedClientConfigRequest")
     * @Type("Zimbra\Admin\Message\GetMemcachedClientConfigRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var GetMemcachedClientConfigRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'GetMemcachedClientConfigRequest')]
    #[Type(name: GetMemcachedClientConfigRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetMemcachedClientConfigResponse")
     * @Type("Zimbra\Admin\Message\GetMemcachedClientConfigResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var GetMemcachedClientConfigResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'GetMemcachedClientConfigResponse')]
    #[Type(name: GetMemcachedClientConfigResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param GetMemcachedClientConfigRequest $request
     * @param GetMemcachedClientConfigResponse $response
     * @return self
     */
    public function __construct(
        ?GetMemcachedClientConfigRequest $request = NULL, ?GetMemcachedClientConfigResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetMemcachedClientConfigRequest) {
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
        if ($response instanceof GetMemcachedClientConfigResponse) {
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
