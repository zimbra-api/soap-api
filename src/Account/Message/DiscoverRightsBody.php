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
 * DiscoverRightsBody class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DiscoverRightsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("DiscoverRightsRequest")
     * @Type("Zimbra\Account\Message\DiscoverRightsRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     *
     * @var SoapRequestInterface
     */
    #[Accessor(getter: "getRequest", setter: "setRequest")]
    #[SerializedName("DiscoverRightsRequest")]
    #[Type(DiscoverRightsRequest::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?SoapRequestInterface $request = null;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("DiscoverRightsResponse")
     * @Type("Zimbra\Account\Message\DiscoverRightsResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     *
     * @var SoapResponseInterface
     */
    #[Accessor(getter: "getResponse", setter: "setResponse")]
    #[SerializedName("DiscoverRightsResponse")]
    #[Type(DiscoverRightsResponse::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?SoapResponseInterface $response = null;

    /**
     * Constructor
     *
     * @param  DiscoverRightsRequest $request
     * @param  DiscoverRightsResponse $response
     * @return self
     */
    public function __construct(
        ?DiscoverRightsRequest $request = null,
        ?DiscoverRightsResponse $response = null
    ) {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof DiscoverRightsRequest) {
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
        if ($response instanceof DiscoverRightsResponse) {
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
