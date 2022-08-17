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
 * GetSystemRetentionPolicyBody class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetSystemRetentionPolicyBody extends SoapBody
{
    /**
     * @var GetSystemRetentionPolicyRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'GetSystemRetentionPolicyRequest')]
    #[Type(name: GetSystemRetentionPolicyRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $request;

    /**
     * @var GetSystemRetentionPolicyResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'GetSystemRetentionPolicyResponse')]
    #[Type(name: GetSystemRetentionPolicyResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $response;

    /**
     * Constructor
     *
     * @return self
     */
    public function __construct(
        ?GetSystemRetentionPolicyRequest $request = NULL, ?GetSystemRetentionPolicyResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetSystemRetentionPolicyRequest) {
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
        if ($response instanceof GetSystemRetentionPolicyResponse) {
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
