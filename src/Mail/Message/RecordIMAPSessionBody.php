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
use Zimbra\Common\Struct\{
    SoapBody,
    SoapRequestInterface,
    SoapResponseInterface
};

/**
 * RecordIMAPSessionBody class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RecordIMAPSessionBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("RecordIMAPSessionRequest")
     * @Type("Zimbra\Mail\Message\RecordIMAPSessionRequest")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var SoapRequestInterface
     */
    #[Accessor(getter: "getRequest", setter: "setRequest")]
    #[SerializedName("RecordIMAPSessionRequest")]
    #[Type(RecordIMAPSessionRequest::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?SoapRequestInterface $request = null;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("RecordIMAPSessionResponse")
     * @Type("Zimbra\Mail\Message\RecordIMAPSessionResponse")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var SoapResponseInterface
     */
    #[Accessor(getter: "getResponse", setter: "setResponse")]
    #[SerializedName("RecordIMAPSessionResponse")]
    #[Type(RecordIMAPSessionResponse::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?SoapResponseInterface $response = null;

    /**
     * Constructor
     *
     * @param  RecordIMAPSessionRequest $request
     * @param  RecordIMAPSessionResponse $response
     * @return self
     */
    public function __construct(
        ?RecordIMAPSessionRequest $request = null,
        ?RecordIMAPSessionResponse $response = null
    ) {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof RecordIMAPSessionRequest) {
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
        if ($response instanceof RecordIMAPSessionResponse) {
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
