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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Soap\{BodyInterface, Envelope, Header};

/**
 * GetAllCalendarResourcesEnvelope class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 * @XmlRoot(name="soap:Envelope")
 */
class GetAllCalendarResourcesEnvelope extends Envelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Admin\Message\GetAllCalendarResourcesBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $body;

    /**
     * Constructor method for GetAllCalendarResourcesEnvelope
     *
     * @return self
     */
    public function __construct(?GetAllCalendarResourcesBody $body = NULL, ?Header $header = NULL)
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
        if ($body instanceof GetAllCalendarResourcesBody) {
            $this->body = $body;
        }
        return $this;
    }
}