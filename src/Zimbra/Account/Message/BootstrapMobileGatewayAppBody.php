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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Soap\{Body, BodyInterface, RequestInterface, ResponseInterface};

/**
 * BootstrapMobileGatewayAppBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 * @AccessType("public_method")
 * @XmlRoot(name="Body")
 */
class BootstrapMobileGatewayAppBody extends Body
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("BootstrapMobileGatewayAppRequest")
     * @Type("Zimbra\Account\Message\BootstrapMobileGatewayAppRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("BootstrapMobileGatewayAppResponse")
     * @Type("Zimbra\Account\Message\BootstrapMobileGatewayAppResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private $response;

    /**
     * Constructor method for BootstrapMobileGatewayAppBody
     * @return self
     */
    public function __construct(BootstrapMobileGatewayAppRequest $request = NULL, BootstrapMobileGatewayAppResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    public function setRequest(RequestInterface $request): self
    {
        if ($request instanceof BootstrapMobileGatewayAppRequest) {
            $this->request = $request;
        }
        return $this;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function setResponse(ResponseInterface $response): self
    {
        if ($response instanceof BootstrapMobileGatewayAppResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
