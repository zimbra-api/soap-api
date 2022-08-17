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
 * ModifyWhiteBlackListBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyWhiteBlackListBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("ModifyWhiteBlackListRequest")
     * @Type("Zimbra\Account\Message\ModifyWhiteBlackListRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var ModifyWhiteBlackListRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'ModifyWhiteBlackListRequest')]
    #[Type(name: ModifyWhiteBlackListRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("ModifyWhiteBlackListResponse")
     * @Type("Zimbra\Account\Message\ModifyWhiteBlackListResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var ModifyWhiteBlackListResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'ModifyWhiteBlackListResponse')]
    #[Type(name: ModifyWhiteBlackListResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $response;

    /**
     * Constructor
     *
     * @param  ModifyWhiteBlackListRequest $request
     * @param  ModifyWhiteBlackListResponse $response
     * @return self
     */
    public function __construct(
        ?ModifyWhiteBlackListRequest $request = NULL, ?ModifyWhiteBlackListResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof ModifyWhiteBlackListRequest) {
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
        if ($response instanceof ModifyWhiteBlackListResponse) {
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
