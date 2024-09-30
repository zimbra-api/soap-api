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
 * ContactBackupBody class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ContactBackupBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("ContactBackupRequest")
     * @Type("Zimbra\Admin\Message\ContactBackupRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var SoapRequestInterface
     */
    #[Accessor(getter: "getRequest", setter: "setRequest")]
    #[SerializedName("ContactBackupRequest")]
    #[Type(ContactBackupRequest::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?SoapRequestInterface $request = null;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("ContactBackupResponse")
     * @Type("Zimbra\Admin\Message\ContactBackupResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var SoapResponseInterface
     */
    #[Accessor(getter: "getResponse", setter: "setResponse")]
    #[SerializedName("ContactBackupResponse")]
    #[Type(ContactBackupResponse::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?SoapResponseInterface $response = null;

    /**
     * Constructor
     *
     * @param ContactBackupRequest $request
     * @param ContactBackupResponse $response
     * @return self
     */
    public function __construct(
        ?ContactBackupRequest $request = null,
        ?ContactBackupResponse $response = null
    ) {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof ContactBackupRequest) {
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
        if ($response instanceof ContactBackupResponse) {
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
