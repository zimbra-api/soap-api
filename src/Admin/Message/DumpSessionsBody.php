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
use Zimbra\Common\Struct\{
    SoapBody,
    SoapRequestInterface,
    SoapResponseInterface
};

/**
 * DumpSessionsBody class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DumpSessionsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("DumpSessionsRequest")
     * @Type("Zimbra\Admin\Message\DumpSessionsRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var SoapRequestInterface
     */
    #[Accessor(getter: "getRequest", setter: "setRequest")]
    #[SerializedName("DumpSessionsRequest")]
    #[Type(DumpSessionsRequest::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?SoapRequestInterface $request = null;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("DumpSessionsResponse")
     * @Type("Zimbra\Admin\Message\DumpSessionsResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var SoapResponseInterface
     */
    #[Accessor(getter: "getResponse", setter: "setResponse")]
    #[SerializedName("DumpSessionsResponse")]
    #[Type(DumpSessionsResponse::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?SoapResponseInterface $response = null;

    /**
     * Constructor
     *
     * @param DumpSessionsRequest $request
     * @param DumpSessionsResponse $response
     * @return self
     */
    public function __construct(
        ?DumpSessionsRequest $request = null,
        ?DumpSessionsResponse $response = null
    ) {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof DumpSessionsRequest) {
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
        if ($response instanceof DumpSessionsResponse) {
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
