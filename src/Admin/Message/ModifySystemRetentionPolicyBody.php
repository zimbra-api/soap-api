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
 * ModifySystemRetentionPolicyBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifySystemRetentionPolicyBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("ModifySystemRetentionPolicyRequest")
     * @Type("Zimbra\Admin\Message\ModifySystemRetentionPolicyRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var ModifySystemRetentionPolicyRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'ModifySystemRetentionPolicyRequest')]
    #[Type(name: ModifySystemRetentionPolicyRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("ModifySystemRetentionPolicyResponse")
     * @Type("Zimbra\Admin\Message\ModifySystemRetentionPolicyResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var ModifySystemRetentionPolicyResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'ModifySystemRetentionPolicyResponse')]
    #[Type(name: ModifySystemRetentionPolicyResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param ModifySystemRetentionPolicyRequest $request
     * @param ModifySystemRetentionPolicyResponse $response
     * @return self
     */
    public function __construct(
        ?ModifySystemRetentionPolicyRequest $request = NULL, ?ModifySystemRetentionPolicyResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof ModifySystemRetentionPolicyRequest) {
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
        if ($response instanceof ModifySystemRetentionPolicyResponse) {
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
