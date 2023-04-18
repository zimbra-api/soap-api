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
use Zimbra\Common\Struct\{SoapBody, SoapRequestInterface, SoapResponseInterface};

/**
 * RevokeRightBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RevokeRightBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("RevokeRightRequest")
     * @Type("Zimbra\Admin\Message\RevokeRightRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var SoapRequestInterface
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName('RevokeRightRequest')]
    #[Type(RevokeRightRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("RevokeRightResponse")
     * @Type("Zimbra\Admin\Message\RevokeRightResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var SoapResponseInterface
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName('RevokeRightResponse')]
    #[Type(RevokeRightResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor
     *
     * @param RevokeRightRequest $request
     * @param RevokeRightResponse $response
     * @return self
     */
    public function __construct(
        ?RevokeRightRequest $request = NULL, ?RevokeRightResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof RevokeRightRequest) {
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
        if ($response instanceof RevokeRightResponse) {
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
