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
use Zimbra\Soap\{Body, RequestInterface, ResponseInterface};

/**
 * RevokeRightsBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RevokeRightsBody extends Body
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("RevokeRightsRequest")
     * @Type("Zimbra\Account\Message\RevokeRightsRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private ?RequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("RevokeRightsResponse")
     * @Type("Zimbra\Account\Message\RevokeRightsResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private ?ResponseInterface $response = NULL;

    /**
     * Constructor method for RevokeRightsBody
     *
     * @return self
     */
    public function __construct(
        ?RevokeRightsRequest $request = NULL, ?RevokeRightsResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    public function setRequest(RequestInterface $request): self
    {
        if ($request instanceof RevokeRightsRequest) {
            $this->request = $request;
        }
        return $this;
    }

    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    public function setResponse(ResponseInterface $response): self
    {
        if ($response instanceof RevokeRightsResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
