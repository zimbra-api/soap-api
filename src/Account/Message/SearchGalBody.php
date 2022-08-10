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
 * SearchGalBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchGalBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("SearchGalRequest")
     * @Type("Zimbra\Account\Message\SearchGalRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var SearchGalRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'SearchGalRequest')]
    #[Type(name: SearchGalRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("SearchGalResponse")
     * @Type("Zimbra\Account\Message\SearchGalResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var SearchGalResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'SearchGalResponse')]
    #[Type(name: SearchGalResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $response;

    /**
     * Constructor
     *
     * @param  SearchGalRequest $request
     * @param  SearchGalResponse $response
     * @return self
     */
    public function __construct(
        ?SearchGalRequest $request = NULL, ?SearchGalResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof SearchGalRequest) {
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
        if ($response instanceof SearchGalResponse) {
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
