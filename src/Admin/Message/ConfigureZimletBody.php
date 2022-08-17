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
 * ConfigureZimletBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ConfigureZimletBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("ConfigureZimletRequest")
     * @Type("Zimbra\Admin\Message\ConfigureZimletRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var ConfigureZimletRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'ConfigureZimletRequest')]
    #[Type(name: ConfigureZimletRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("ConfigureZimletResponse")
     * @Type("Zimbra\Admin\Message\ConfigureZimletResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var ConfigureZimletResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'ConfigureZimletResponse')]
    #[Type(name: ConfigureZimletResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param ConfigureZimletRequest $request
     * @param ConfigureZimletResponse $response
     * @return self
     */
    public function __construct(
        ?ConfigureZimletRequest $request = NULL, ?ConfigureZimletResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof ConfigureZimletRequest) {
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
        if ($response instanceof ConfigureZimletResponse) {
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
