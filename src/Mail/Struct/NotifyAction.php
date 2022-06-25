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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * NotifyAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class NotifyAction extends FilterAction
{
    /**
     * Email address
     * @Accessor(getter="getAddress", setter="setAddress")
     * @SerializedName("a")
     * @Type("string")
     * @XmlAttribute
     */
    private $address;

    /**
     * Subject template
     * Can contain variables such as ${SUBJECT}, ${TO}, ${CC}, etc
     * (basically ${any-header-name}; case not important), plus ${BODY} (text body of the message).
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlAttribute
     */
    private $subject;

    /**
     * Maximum body size in bytes
     * @Accessor(getter="getMaxBodySize", setter="setMaxBodySize")
     * @SerializedName("maxBodySize")
     * @Type("integer")
     * @XmlAttribute
     */
    private $maxBodySize;

    /**
     * Body template
     * Can contain variables such as ${SUBJECT}, ${TO}, ${CC}, etc
     * (basically ${any-header-name}; case not important), plus ${BODY} (text body of the message).
     * @Accessor(getter="getContent", setter="setContent")
     * @SerializedName("content")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $content;

    /**
     * Optional - Either "*" or a comma-separated list of header names.
     * @Accessor(getter="getOrigHeaders", setter="setOrigHeaders")
     * @SerializedName("origHeaders")
     * @Type("string")
     * @XmlAttribute
     */
    private $origHeaders;

    /**
     * Constructor method for NotifyAction
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
        ?int $index = NULL,
        ?string $address = NULL,
        ?string $subject = NULL,
        ?int $maxBodySize = NULL,
        ?string $content = NULL,
        ?string $origHeaders = NULL
    )
    {
    	parent::__construct($index);
        if (NULL !== $address) {
            $this->setAddress($address);
        }
        if (NULL !== $subject) {
            $this->setSubject($subject);
        }
        if (NULL !== $maxBodySize) {
            $this->setMaxBodySize($maxBodySize);
        }
        if (NULL !== $content) {
            $this->setContent($content);
        }
        if (NULL !== $origHeaders) {
            $this->setOrigHeaders($origHeaders);
        }
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Sets address
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
     * Gets subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Sets subject
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
     * Gets maxBodySize
     *
     * @return int
     */
    public function getMaxBodySize(): ?int
    {
        return $this->maxBodySize;
    }

    /**
     * Sets maxBodySize
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
     * Gets content
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Sets content
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
     * Gets origHeaders
     *
     * @return string
     */
    public function getOrigHeaders(): ?string
    {
        return $this->origHeaders;
    }

    /**
     * Sets origHeaders
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
