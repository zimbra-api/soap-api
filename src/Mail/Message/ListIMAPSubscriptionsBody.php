<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{SoapBody, SoapRequestInterface, SoapResponseInterface};

/**
 * ListIMAPSubscriptionsBody class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ListIMAPSubscriptionsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("ListIMAPSubscriptionsRequest")
     * @Type("Zimbra\Mail\Message\ListIMAPSubscriptionsRequest")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ListIMAPSubscriptionsRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName('ListIMAPSubscriptionsRequest')]
    #[Type(ListIMAPSubscriptionsRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("ListIMAPSubscriptionsResponse")
     * @Type("Zimbra\Mail\Message\ListIMAPSubscriptionsResponse")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var ListIMAPSubscriptionsResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName('ListIMAPSubscriptionsResponse')]
    #[Type(ListIMAPSubscriptionsResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $response;

    /**
     * Constructor
     *
     * @param  ListIMAPSubscriptionsRequest $request
     * @param  ListIMAPSubscriptionsResponse $response
     * @return self
     */
    public function __construct(
        ?ListIMAPSubscriptionsRequest $request = NULL, ?ListIMAPSubscriptionsResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof ListIMAPSubscriptionsRequest) {
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
        if ($response instanceof ListIMAPSubscriptionsResponse) {
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
