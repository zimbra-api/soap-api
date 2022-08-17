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
 * PurgeAccountCalendarCacheBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class PurgeAccountCalendarCacheBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("PurgeAccountCalendarCacheRequest")
     * @Type("Zimbra\Admin\Message\PurgeAccountCalendarCacheRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var PurgeAccountCalendarCacheRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'PurgeAccountCalendarCacheRequest')]
    #[Type(name: PurgeAccountCalendarCacheRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("PurgeAccountCalendarCacheResponse")
     * @Type("Zimbra\Admin\Message\PurgeAccountCalendarCacheResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var PurgeAccountCalendarCacheResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'PurgeAccountCalendarCacheResponse')]
    #[Type(name: PurgeAccountCalendarCacheResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param PurgeAccountCalendarCacheRequest $request
     * @param PurgeAccountCalendarCacheResponse $response
     * @return self
     */
    public function __construct(
        ?PurgeAccountCalendarCacheRequest $request = NULL, ?PurgeAccountCalendarCacheResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof PurgeAccountCalendarCacheRequest) {
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
        if ($response instanceof PurgeAccountCalendarCacheResponse) {
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
