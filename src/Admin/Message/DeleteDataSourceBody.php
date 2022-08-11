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
 * DeleteDataSourceBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeleteDataSourceBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("DeleteDataSourceRequest")
     * @Type("Zimbra\Admin\Message\DeleteDataSourceRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var DeleteDataSourceRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'DeleteDataSourceRequest')]
    #[Type(name: DeleteDataSourceRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("DeleteDataSourceResponse")
     * @Type("Zimbra\Admin\Message\DeleteDataSourceResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var DeleteDataSourceResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'DeleteDataSourceResponse')]
    #[Type(name: DeleteDataSourceResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param DeleteDataSourceRequest $request
     * @param DeleteDataSourceResponse $response
     * @return self
     */
    public function __construct(
        ?DeleteDataSourceRequest $request = NULL, ?DeleteDataSourceResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof DeleteDataSourceRequest) {
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
        if ($response instanceof DeleteDataSourceResponse) {
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
