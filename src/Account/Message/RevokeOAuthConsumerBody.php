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
 * RevokeOAuthConsumerBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RevokeOAuthConsumerBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("RevokeOAuthConsumerRequest")
     * @Type("Zimbra\Account\Message\RevokeOAuthConsumerRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'RevokeOAuthConsumerRequest')]
    #[Type(name: RevokeOAuthConsumerRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("RevokeOAuthConsumerResponse")
     * @Type("Zimbra\Account\Message\RevokeOAuthConsumerResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var RevokeOAuthConsumerResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'RevokeOAuthConsumerResponse')]
    #[Type(name: RevokeOAuthConsumerResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $response;

    /**
     * Constructor
     *
     * @param  RevokeOAuthConsumerRequest $request
     * @param  RevokeOAuthConsumerResponse $response
     * @return self
     */
    public function __construct(
        ?RevokeOAuthConsumerRequest $request = NULL, ?RevokeOAuthConsumerResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof RevokeOAuthConsumerRequest) {
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
        if ($response instanceof RevokeOAuthConsumerResponse) {
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
