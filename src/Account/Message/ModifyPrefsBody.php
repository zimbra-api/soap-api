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
 * ModifyPrefsBody class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyPrefsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("ModifyPrefsRequest")
     * @Type("Zimbra\Account\Message\ModifyPrefsRequest")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var SoapRequestInterface
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName('ModifyPrefsRequest')]
    #[Type(ModifyPrefsRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("ModifyPrefsResponse")
     * @Type("Zimbra\Account\Message\ModifyPrefsResponse")
     * @XmlElement(namespace="urn:zimbraAccount")
     * 
     * @var SoapResponseInterface
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName('ModifyPrefsResponse')]
    #[Type(ModifyPrefsResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor
     *
     * @param  ModifyPrefsRequest $request
     * @param  ModifyPrefsResponse $response
     * @return self
     */
    public function __construct(
        ?ModifyPrefsRequest $request = NULL, ?ModifyPrefsResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof ModifyPrefsRequest) {
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
        if ($response instanceof ModifyPrefsResponse) {
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
