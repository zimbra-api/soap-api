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
 * GetAllLocalesBody class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllLocalesBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetAllLocalesRequest")
     * @Type("Zimbra\Admin\Message\GetAllLocalesRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var SoapRequestInterface
     */
    #[Accessor(getter: "getRequest", setter: "setRequest")]
    #[SerializedName("GetAllLocalesRequest")]
    #[Type(GetAllLocalesRequest::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?SoapRequestInterface $request = null;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetAllLocalesResponse")
     * @Type("Zimbra\Admin\Message\GetAllLocalesResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var SoapResponseInterface
     */
    #[Accessor(getter: "getResponse", setter: "setResponse")]
    #[SerializedName("GetAllLocalesResponse")]
    #[Type(GetAllLocalesResponse::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?SoapResponseInterface $response = null;

    /**
     * Constructor
     *
     * @param GetAllLocalesRequest $request
     * @param GetAllLocalesResponse $response
     * @return self
     */
    public function __construct(
        ?GetAllLocalesRequest $request = null,
        ?GetAllLocalesResponse $response = null
    ) {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetAllLocalesRequest) {
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
        if ($response instanceof GetAllLocalesResponse) {
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
