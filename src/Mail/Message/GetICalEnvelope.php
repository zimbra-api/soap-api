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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Common\Struct\{SoapBodyInterface, SoapEnvelope, SoapHeaderInterface};

/**
 * GetICalEnvelope class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 * @XmlRoot(name="soap:Envelope")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
#[XmlRoot(name: 'soap:Envelope')]
class GetICalEnvelope extends SoapEnvelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Mail\Message\GetICalBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     * 
     * @var GetICalBody
     */
    #[Accessor(getter: 'getBody', setter: 'setBody')]
    #[SerializedName('Body')]
    #[Type(GetICalBody::class)]
    #[XmlElement(namespace: 'http://www.w3.org/2003/05/soap-envelope')]
    private $body;

    /**
     * Constructor
     *
     * @param  GetICalBody $body
     * @param  SoapHeaderInterface $header
     * @return self
     */
    public function __construct(?GetICalBody $body = NULL, ?SoapHeaderInterface $header = NULL)
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
        if ($body instanceof GetICalBody) {
            $this->body = $body;
        }
        return $this;
    }
}
