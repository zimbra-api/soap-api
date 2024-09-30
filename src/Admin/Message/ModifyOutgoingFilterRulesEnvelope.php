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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlNamespace,
    XmlRoot
};
use Zimbra\Common\Struct\{SoapBodyInterface, SoapEnvelope, SoapHeaderInterface};

/**
 * ModifyOutgoingFilterRulesEnvelope class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn1")
 * @XmlRoot(name="soap:Envelope")
 */
#[XmlNamespace(uri: "urn:zimbraAdmin", prefix: "urn")]
#[XmlNamespace(uri: "urn:zimbraMail", prefix: "urn1")]
#[XmlRoot(name: "soap:Envelope")]
class ModifyOutgoingFilterRulesEnvelope extends SoapEnvelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Admin\Message\ModifyOutgoingFilterRulesBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     *
     * @var SoapBodyInterface
     */
    #[Accessor(getter: "getBody", setter: "setBody")]
    #[SerializedName("Body")]
    #[Type(ModifyOutgoingFilterRulesBody::class)]
    #[XmlElement(namespace: "http://www.w3.org/2003/05/soap-envelope")]
    private ?SoapBodyInterface $body = null;

    /**
     * Constructor
     *
     * @param ModifyOutgoingFilterRulesBody $body
     * @param SoapHeaderInterface $header
     * @return self
     */
    public function __construct(
        ?ModifyOutgoingFilterRulesBody $body = null,
        ?SoapHeaderInterface $header = null
    ) {
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
        if ($body instanceof ModifyOutgoingFilterRulesBody) {
            $this->body = $body;
        }
        return $this;
    }
}
