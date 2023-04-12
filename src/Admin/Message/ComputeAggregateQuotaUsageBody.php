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
 * ComputeAggregateQuotaUsageBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ComputeAggregateQuotaUsageBody extends SoapBody
{
    /**
     * Soap request
     * 
     * @var SoapRequestInterface
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName('ComputeAggregateQuotaUsageRequest')]
    #[Type(ComputeAggregateQuotaUsageRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?SoapRequestInterface $request = NULL;

    /**
     * Soap response
     * 
     * @var SoapResponseInterface
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName('ComputeAggregateQuotaUsageResponse')]
    #[Type(ComputeAggregateQuotaUsageResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor
     *
     * @param ComputeAggregateQuotaUsageRequest $request
     * @param ComputeAggregateQuotaUsageResponse $response
     * @return self
     */
    public function __construct(
        ?ComputeAggregateQuotaUsageRequest $request = NULL, ?ComputeAggregateQuotaUsageResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof ComputeAggregateQuotaUsageRequest) {
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
        if ($response instanceof ComputeAggregateQuotaUsageResponse) {
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
