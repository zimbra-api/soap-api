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
 * AdminDestroyWaitSetBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AdminDestroyWaitSetBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("AdminDestroyWaitSetRequest")
     * @Type("Zimbra\Admin\Message\AdminDestroyWaitSetRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var AdminDestroyWaitSetRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'AdminDestroyWaitSetRequest')]
    #[Type(name: AdminDestroyWaitSetRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("AdminDestroyWaitSetResponse")
     * @Type("Zimbra\Admin\Message\AdminDestroyWaitSetResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var AdminDestroyWaitSetResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'AdminDestroyWaitSetResponse')]
    #[Type(name: AdminDestroyWaitSetResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param AdminDestroyWaitSetRequest $request
     * @param AdminDestroyWaitSetResponse $response
     * @return self
     */
    public function __construct(
        ?AdminDestroyWaitSetRequest $request = NULL, ?AdminDestroyWaitSetResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof AdminDestroyWaitSetRequest) {
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
        if ($response instanceof AdminDestroyWaitSetResponse) {
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
