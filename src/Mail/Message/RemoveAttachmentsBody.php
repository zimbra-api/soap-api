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
 * RemoveAttachmentsBody class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RemoveAttachmentsBody extends SoapBody
{
    /**
     * @var RemoveAttachmentsRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'RemoveAttachmentsRequest')]
    #[Type(name: RemoveAttachmentsRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $request;

    /**
     * @var RemoveAttachmentsResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'RemoveAttachmentsResponse')]
    #[Type(name: RemoveAttachmentsResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $response;

    /**
     * Constructor
     *
     * @param  RemoveAttachmentsRequest $request
     * @param  RemoveAttachmentsResponse $response
     * @return self
     */
    public function __construct(
        ?RemoveAttachmentsRequest $request = NULL, ?RemoveAttachmentsResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof RemoveAttachmentsRequest) {
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
        if ($response instanceof RemoveAttachmentsResponse) {
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
