<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap\Fault;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};

/**
 * Soap fault envelope class
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 * @XmlNamespace(uri="http://www.w3.org/2003/05/soap-envelope", prefix="soap")
 * @XmlRoot(name="soap:Envelope")
 */
class Envelope
{
    /**
     * Soap fault body
     * 
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Common\Soap\Fault\Body")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     * @var Body
     */
    private ?Body $body = NULL;

    /**
     * Get the soap fault body
     *
     * @return BodyInterface
     */
    public function getBody(): ?Body
    {
        return $this->body;
    }

    /**
     * Set the soap fault body
     *
     * @param  Body $body
     * @return self
     */
    public function setBody(Body $body): self
    {
        $this->body = $body;
        return $this;
    }
}
