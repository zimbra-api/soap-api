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
use Zimbra\Common\Struct\{
    SoapBody,
    SoapRequestInterface,
    SoapResponseInterface
};

/**
 * GetDistributionListMembershipBody class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDistributionListMembershipBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetDistributionListMembershipRequest")
     * @Type("Zimbra\Admin\Message\GetDistributionListMembershipRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var SoapRequestInterface
     */
    #[Accessor(getter: "getRequest", setter: "setRequest")]
    #[SerializedName("GetDistributionListMembershipRequest")]
    #[Type(GetDistributionListMembershipRequest::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?SoapRequestInterface $request = null;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetDistributionListMembershipResponse")
     * @Type("Zimbra\Admin\Message\GetDistributionListMembershipResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var SoapResponseInterface
     */
    #[Accessor(getter: "getResponse", setter: "setResponse")]
    #[SerializedName("GetDistributionListMembershipResponse")]
    #[Type(GetDistributionListMembershipResponse::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?SoapResponseInterface $response = null;

    /**
     * Constructor
     *
     * @param GetDistributionListMembershipRequest $request
     * @param GetDistributionListMembershipResponse $response
     * @return self
     */
    public function __construct(
        ?GetDistributionListMembershipRequest $request = null,
        ?GetDistributionListMembershipResponse $response = null
    ) {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetDistributionListMembershipRequest) {
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
        if ($response instanceof GetDistributionListMembershipResponse) {
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
