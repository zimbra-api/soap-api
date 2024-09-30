<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};

/**
 * NotifyAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NotifyAction extends FilterAction
{
    /**
     * Email address
     *
     * @Accessor(getter="getAddress", setter="setAddress")
     * @SerializedName("a")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getAddress", setter: "setAddress")]
    #[SerializedName("a")]
    #[Type("string")]
    #[XmlAttribute]
    private $address;

    /**
     * Subject template
     * Can contain variables such as ${SUBJECT}, ${TO}, ${CC}, etc
     * (basically ${any-header-name}; case not important), plus ${BODY} (text body of the message).
     *
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getSubject", setter: "setSubject")]
    #[SerializedName("su")]
    #[Type("string")]
    #[XmlAttribute]
    private $subject;

    /**
     * Maximum body size in bytes
     *
     * @Accessor(getter="getMaxBodySize", setter="setMaxBodySize")
     * @SerializedName("maxBodySize")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getMaxBodySize", setter: "setMaxBodySize")]
    #[SerializedName("maxBodySize")]
    #[Type("int")]
    #[XmlAttribute]
    private $maxBodySize;

    /**
     * Body template
     * Can contain variables such as ${SUBJECT}, ${TO}, ${CC}, etc
     * (basically ${any-header-name}; case not important), plus ${BODY} (text body of the message).
     *
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     *
     * @var string
     */
    #[Accessor(getter: "getContent", setter: "setContent")]
    #[SerializedName("content")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $content;

    /**
     * Optional - Either "*" or a comma-separated list of header names.
     *
     * @Accessor(getter="getOrigHeaders", setter="setOrigHeaders")
     * @SerializedName("origHeaders")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getOrigHeaders", setter: "setOrigHeaders")]
    #[SerializedName("origHeaders")]
    #[Type("string")]
    #[XmlAttribute]
    private $origHeaders;

    /**
     * Constructor
     *
     * @param int $index
     * @param string $address
     * @param string $subject
     * @param int $maxBodySize
     * @param string $content
     * @param string $origHeaders
     * @return self
     */
    public function __construct(
        ?int $index = null,
        ?string $address = null,
        ?string $subject = null,
        ?int $maxBodySize = null,
        ?string $content = null,
        ?string $origHeaders = null
    ) {
        parent::__construct($index);
        if (null !== $address) {
            $this->setAddress($address);
        }
        if (null !== $subject) {
            $this->setSubject($subject);
        }
        if (null !== $maxBodySize) {
            $this->setMaxBodySize($maxBodySize);
        }
        if (null !== $content) {
            $this->setContent($content);
        }
        if (null !== $origHeaders) {
            $this->setOrigHeaders($origHeaders);
        }
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param  string $address
     * @return self
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set subject
     *
     * @param  string $subject
     * @return self
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get maxBodySize
     *
     * @return int
     */
    public function getMaxBodySize(): ?int
    {
        return $this->maxBodySize;
    }

    /**
     * Set maxBodySize
     *
     * @param  int $maxBodySize
     * @return self
     */
    public function setMaxBodySize(int $maxBodySize)
    {
        $this->maxBodySize = $maxBodySize;
        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param  string $content
     * @return self
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get origHeaders
     *
     * @return string
     */
    public function getOrigHeaders(): ?string
    {
        return $this->origHeaders;
    }

    /**
     * Set origHeaders
     *
     * @param  string $origHeaders
     * @return self
     */
    public function setOrigHeaders(string $origHeaders)
    {
        $this->origHeaders = $origHeaders;
        return $this;
    }
}
