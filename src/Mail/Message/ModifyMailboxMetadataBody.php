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
 * ModifyMailboxMetadataBody class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyMailboxMetadataBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("ModifyMailboxMetadataRequest")
     * @Type("Zimbra\Mail\Message\ModifyMailboxMetadataRequest")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("ModifyMailboxMetadataResponse")
     * @Type("Zimbra\Mail\Message\ModifyMailboxMetadataResponse")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor
     *
     * @param  ModifyMailboxMetadataRequest $request
     * @param  ModifyMailboxMetadataResponse $response
     * @return self
     */
    public function __construct(
        ?ModifyMailboxMetadataRequest $request = NULL, ?ModifyMailboxMetadataResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof ModifyMailboxMetadataRequest) {
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
        if ($response instanceof ModifyMailboxMetadataResponse) {
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
