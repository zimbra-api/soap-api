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
 * GetModifiedItemsIDsBody class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetModifiedItemsIDsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetModifiedItemsIDsRequest")
     * @Type("Zimbra\Mail\Message\GetModifiedItemsIDsRequest")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetModifiedItemsIDsResponse")
     * @Type("Zimbra\Mail\Message\GetModifiedItemsIDsResponse")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor
     *
     * @param  GetModifiedItemsIDsRequest $request
     * @param  GetModifiedItemsIDsResponse $response
     * @return self
     */
    public function __construct(
        ?GetModifiedItemsIDsRequest $request = NULL, ?GetModifiedItemsIDsResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetModifiedItemsIDsRequest) {
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
        if ($response instanceof GetModifiedItemsIDsResponse) {
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
