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
 * NoOpBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NoOpBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("NoOpRequest")
     * @Type("Zimbra\Admin\Message\NoOpRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'NoOpRequest')]
    #[Type(name: NoOpRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("NoOpResponse")
     * @Type("Zimbra\Admin\Message\NoOpResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var NoOpResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'NoOpResponse')]
    #[Type(name: NoOpResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param NoOpRequest $request
     * @param NoOpResponse $response
     * @return self
     */
    public function __construct(?NoOpRequest $request = NULL, ?NoOpResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof NoOpRequest) {
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
        if ($response instanceof NoOpResponse) {
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
