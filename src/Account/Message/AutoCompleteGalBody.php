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
 * AutoCompleteGalBody class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AutoCompleteGalBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("AutoCompleteGalRequest")
     * @Type("Zimbra\Account\Message\AutoCompleteGalRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     *
     * @var SoapRequestInterface
     */
    #[Accessor(getter: "getRequest", setter: "setRequest")]
    #[SerializedName("AutoCompleteGalRequest")]
    #[Type(AutoCompleteGalRequest::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?SoapRequestInterface $request = null;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("AutoCompleteGalResponse")
     * @Type("Zimbra\Account\Message\AutoCompleteGalResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     *
     * @var SoapResponseInterface
     */
    #[Accessor(getter: "getResponse", setter: "setResponse")]
    #[SerializedName("AutoCompleteGalResponse")]
    #[Type(AutoCompleteGalResponse::class)]
    #[XmlElement(namespace: "urn:zimbraAccount")]
    private ?SoapResponseInterface $response = null;

    /**
     * Constructor
     *
     * @param  AutoCompleteGalRequest $request
     * @param  AutoCompleteGalResponse $response
     * @return self
     */
    public function __construct(
        ?AutoCompleteGalRequest $request = null,
        ?AutoCompleteGalResponse $response = null
    ) {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof AutoCompleteGalRequest) {
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
        if ($response instanceof AutoCompleteGalResponse) {
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
