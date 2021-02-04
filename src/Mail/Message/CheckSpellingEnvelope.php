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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Soap\{BodyInterface, Envelope, Header};

/**
 * CheckSpellingEnvelope class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 * @XmlRoot(name="soap:Envelope")
 */
class CheckSpellingEnvelope extends Envelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Mail\Message\CheckSpellingBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $body;

    /**
     * Constructor method for CheckSpellingEnvelope
     *
     * @return self
     */
    public function __construct(?CheckSpellingBody $body = NULL, ?Header $header = NULL)
    {
        parent::__construct($body, $header);
    }

    /**
     * Gets soap message body
     *
     * @return BodyInterface
     */
    public function getBody(): ?BodyInterface
    {
        return $this->body;
    }

    /**
     * Sets soap message body
     *
     * @param  BodyInterface $body
     * @return self
     */
    public function setBody(BodyInterface $body): self
    {
        if ($body instanceof CheckSpellingBody) {
            $this->body = $body;
        }
        return $this;
    }
}
