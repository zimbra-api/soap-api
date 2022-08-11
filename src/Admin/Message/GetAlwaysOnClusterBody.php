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
 * GetAlwaysOnClusterBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAlwaysOnClusterBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetAlwaysOnClusterRequest")
     * @Type("Zimbra\Admin\Message\GetAlwaysOnClusterRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var GetAlwaysOnClusterRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'GetAlwaysOnClusterRequest')]
    #[Type(name: GetAlwaysOnClusterRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetAlwaysOnClusterResponse")
     * @Type("Zimbra\Admin\Message\GetAlwaysOnClusterResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var GetAlwaysOnClusterResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'GetAlwaysOnClusterResponse')]
    #[Type(name: GetAlwaysOnClusterResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param GetAlwaysOnClusterRequest $request
     * @param GetAlwaysOnClusterResponse $response
     * @return self
     */
    public function __construct(
        ?GetAlwaysOnClusterRequest $request = NULL, ?GetAlwaysOnClusterResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetAlwaysOnClusterRequest) {
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
        if ($response instanceof GetAlwaysOnClusterResponse) {
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
