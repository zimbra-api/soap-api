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
 * ModifySignatureBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifySignatureBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("ModifySignatureRequest")
     * @Type("Zimbra\Account\Message\ModifySignatureRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'ModifySignatureRequest')]
    #[Type(name: ModifySignatureRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("ModifySignatureResponse")
     * @Type("Zimbra\Account\Message\ModifySignatureResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var ModifySignatureResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'ModifySignatureResponse')]
    #[Type(name: ModifySignatureResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $response;

    /**
     * Constructor
     *
     * @param  ModifySignatureRequest $request
     * @param  ModifySignatureResponse $response
     * @return self
     */
    public function __construct(
        ?ModifySignatureRequest $request = NULL, ?ModifySignatureResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof ModifySignatureRequest) {
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
        if ($response instanceof ModifySignatureResponse) {
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
