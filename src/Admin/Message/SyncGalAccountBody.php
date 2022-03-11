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
use Zimbra\Soap\{Body, RequestInterface, ResponseInterface};

/**
 * SyncGalAccountBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SyncGalAccountBody extends Body
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("SyncGalAccountRequest")
     * @Type("Zimbra\Admin\Message\SyncGalAccountRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("SyncGalAccountResponse")
     * @Type("Zimbra\Admin\Message\SyncGalAccountResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private $response;

    /**
     * Constructor method for SyncGalAccountBody
     *
     * @return self
     */
    public function __construct(?SyncGalAccountRequest $request = NULL, ?SyncGalAccountResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    public function setRequest(RequestInterface $request): self
    {
        if ($request instanceof SyncGalAccountRequest) {
            $this->request = $request;
        }
        return $this;
    }

    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    public function setResponse(ResponseInterface $response): self
    {
        if ($response instanceof SyncGalAccountResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
