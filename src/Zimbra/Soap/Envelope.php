<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;

/**
 * Soap envelope class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlNamespace(uri="http://www.w3.org/2003/05/soap-envelope", prefix="soap")
 */
abstract class Envelope
{
    /**
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("Header")
     * @Type("Zimbra\Soap\Header")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $_header;

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
     * @return string
     */
    public function getHeader()
    {
        return $this->_header;
    }

    /**
     * Sets soap message header
     *
     * @param  Header $header
     * @return self
     */
    public function setHeader(Header $header)
    {
        $this->_header = $header;
        return $this;
    }

    /**
     * Gets soap message body
     *
     * @return string
     */
    abstract public function getBody();

    /**
     * Sets soap message body
     *
     * @param  BodyInterface $body
     * @return self
     */
    abstract public function setBody(BodyInterface $body);
}
