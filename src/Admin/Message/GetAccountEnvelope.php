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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Common\Struct\{SoapBodyInterface, SoapEnvelope, SoapHeaderInterface};

/**
 * GetAccountEnvelope class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
#[XmlRoot(name: 'soap:Envelope')]
class GetAccountEnvelope extends SoapEnvelope
{
    /**
     * Soap body
     * 
     * @var SoapBodyInterface
     */
    #[Accessor(getter: 'getBody', setter: 'setBody')]
    #[SerializedName('Body')]
    #[Type(GetAccountBody::class)]
    #[XmlElement(namespace: SoapEnvelope::SOAP_NAMESPACE)]
    private ?SoapBodyInterface $body = NULL;

    /**
     * Constructor
     *
     * @param GetAccountBody $body
     * @param SoapHeaderInterface $header
     * @return self
     */
    public function __construct(
        ?GetAccountBody $body = NULL, ?SoapHeaderInterface $header = NULL
    )
    {
        parent::__construct($body, $header);
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): ?SoapBodyInterface
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function setBody(SoapBodyInterface $body): self
    {
        if ($body instanceof GetAccountBody) {
            $this->body = $body;
        }
        return $this;
    }
}
