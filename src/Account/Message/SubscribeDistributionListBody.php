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
 * SubscribeDistributionListBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SubscribeDistributionListBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("SubscribeDistributionListRequest")
     * @Type("Zimbra\Account\Message\SubscribeDistributionListRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("SubscribeDistributionListResponse")
     * @Type("Zimbra\Account\Message\SubscribeDistributionListResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     */
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor method for SubscribeDistributionListBody
     *
     * @return self
     */
    public function __construct(
        ?SubscribeDistributionListRequest $request = NULL, ?SubscribeDistributionListResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof SubscribeDistributionListRequest) {
            $this->request = $request;
        }
        return $this;
    }

    public function getRequest(): ?SoapRequestInterface
    {
        return $this->request;
    }

    public function setResponse(SoapResponseInterface $response): self
    {
        if ($response instanceof SubscribeDistributionListResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?SoapResponseInterface
    {
        return $this->response;
    }
}
