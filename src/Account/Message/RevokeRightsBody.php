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
use Zimbra\Common\Struct\{
    SoapBody,
    SoapRequestInterface,
    SoapResponseInterface
};

/**
 * RevokeRightsBody class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RevokeRightsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("RevokeRightsRequest")
     * @Type("Zimbra\Account\Message\RevokeRightsRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     *
     * @var SoapRequestInterface
     */
    #[Accessor(getter: "getRequest", setter: "setRequest")]
    #[SerializedName("RevokeRightsRequest")]
    #[Type(RevokeRightsRequest::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?SoapRequestInterface $request = null;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("RevokeRightsResponse")
     * @Type("Zimbra\Account\Message\RevokeRightsResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     *
     * @var SoapResponseInterface
     */
    #[Accessor(getter: "getResponse", setter: "setResponse")]
    #[SerializedName("RevokeRightsResponse")]
    #[Type(RevokeRightsResponse::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?SoapResponseInterface $response = null;

    /**
     * Constructor
     *
     * @param  RevokeRightsRequest $request
     * @param  RevokeRightsResponse $response
     * @return self
     */
    public function __construct(
        ?RevokeRightsRequest $request = null,
        ?RevokeRightsResponse $response = null
    ) {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof RevokeRightsRequest) {
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
        if ($response instanceof RevokeRightsResponse) {
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
