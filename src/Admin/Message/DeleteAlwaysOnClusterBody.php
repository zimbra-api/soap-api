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
 * DeleteAlwaysOnClusterBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteAlwaysOnClusterBody extends Body
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("DeleteAlwaysOnClusterRequest")
     * @Type("Zimbra\Admin\Message\DeleteAlwaysOnClusterRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("DeleteAlwaysOnClusterResponse")
     * @Type("Zimbra\Admin\Message\DeleteAlwaysOnClusterResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private $response;

    /**
     * Constructor method for DeleteAlwaysOnClusterBody
     *
     * @return self
     */
    public function __construct(
        ?DeleteAlwaysOnClusterRequest $request = NULL, ?DeleteAlwaysOnClusterResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    public function setRequest(RequestInterface $request): self
    {
        if ($request instanceof DeleteAlwaysOnClusterRequest) {
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
        if ($response instanceof DeleteAlwaysOnClusterResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
