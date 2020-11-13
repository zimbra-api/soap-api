<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Zimbra\Soap;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace};

/**
 * Soap envelope class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @XmlNamespace(uri="http://www.w3.org/2003/05/soap-envelope", prefix="soap")
 */
abstract class Envelope implements EnvelopeInterface
{
    /**
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("Header")
     * @Type("Zimbra\Soap\Header")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $header;

    /**
     * Constructor method for Envelope
     * @return self
     */
    public function __construct(Header $header = NULL, BodyInterface $body = NULL)
    {
        if ($header instanceof Header) {
            $this->setHeader($header);
        }
        if ($body instanceof BodyInterface) {
            $this->setBody($body);
        }
    }

    /**
     * Gets soap message header
     *
     * @return Header
     */
    public function getHeader(): ?Header
    {
        return $this->header;
    }

    /**
     * Sets soap message header
     *
     * @param  Header $header
     * @return self
     */
    public function setHeader(Header $header): self
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Sets soap message body
     *
     * @param  BodyInterface $body
     * @return self
     */
    abstract public function setBody(BodyInterface $body): self;
}
