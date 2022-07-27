<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Zimbra\Common\Soap;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace};

/**
 * Soap envelope class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 * @XmlNamespace(uri="http://www.w3.org/2003/05/soap-envelope", prefix="soap")
 */
abstract class Envelope implements EnvelopeInterface
{
    /**
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("Header")
     * @Type("Zimbra\Common\Soap\Header")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private ?Header $header = NULL;

    /**
     * Constructor
     * 
     * @param  BodyInterface $body
     * @param  Header $header
     * @return self
     */
    public function __construct(?BodyInterface $body = NULL, ?Header $header = NULL)
    {
        if ($body instanceof BodyInterface) {
            $this->setBody($body);
        }
        if ($header instanceof Header) {
            $this->setHeader($header);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader(): ?Header
    {
        return $this->header;
    }

    /**
     * Set soap message header
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
     * Set soap message body
     *
     * @param  BodyInterface $body
     * @return self
     */
    abstract public function setBody(BodyInterface $body): self;
}
