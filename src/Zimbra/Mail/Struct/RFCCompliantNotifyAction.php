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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};

/**
 * RFCCompliantNotifyAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="actionRFCCompliantNotify")
 */
class RFCCompliantNotifyAction extends FilterAction
{
    /**
     * Notify Tag ":from"
     * @Accessor(getter="getFrom", setter="setFrom")
     * @SerializedName("from")
     * @Type("string")
     * @XmlAttribute
     */
    private $from;

    /**
     * Notify Tag ":importance"
     * @Accessor(getter="getImportance", setter="setImportance")
     * @SerializedName("importance")
     * @Type("string")
     * @XmlAttribute
     */
    private $importance;

    /**
     * Notify Tag ":options"
     * @Accessor(getter="getOptions", setter="setOptions")
     * @SerializedName("options")
     * @Type("string")
     * @XmlAttribute
     */
    private $options;

    /**
     * Notify Tag ":message"
     * @Accessor(getter="getMessage", setter="setMessage")
     * @SerializedName("message")
     * @Type("string")
     * @XmlAttribute
     */
    private $message;

    /**
     * Notify Parameter "method"
     * @Accessor(getter="getMethod", setter="setMethod")
     * @SerializedName("method")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $method;

    /**
     * Constructor method for RFCCompliantNotifyAction
     * 
     * @param int $index
     * @param string $from
     * @param string $importance
     * @param string $options
     * @param string $message
     * @param string $method
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?string $from = NULL,
        ?string $importance = NULL,
        ?string $options = NULL,
        ?string $message = NULL,
        ?string $method = NULL
    )
    {
    	parent::__construct($index);
        if (NULL !== $from) {
            $this->setFrom($from);
        }
        if (NULL !== $importance) {
            $this->setImportance($importance);
        }
        if (NULL !== $options) {
            $this->setOptions($options);
        }
        if (NULL !== $message) {
            $this->setMessage($message);
        }
        if (NULL !== $method) {
            $this->setMethod($method);
        }
    }

    /**
     * Gets from
     *
     * @return string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * Sets from
     *
     * @param  string $from
     * @return self
     */
    public function setFrom(string $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Gets importance
     *
     * @return string
     */
    public function getImportance(): ?string
    {
        return $this->importance;
    }

    /**
     * Sets importance
     *
     * @param  string $importance
     * @return self
     */
    public function setImportance(string $importance)
    {
        $this->importance = $importance;
        return $this;
    }

    /**
     * Gets options
     *
     * @return int
     */
    public function getOptions(): ?string
    {
        return $this->options;
    }

    /**
     * Sets options
     *
     * @param  string $options
     * @return self
     */
    public function setOptions(string $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Gets message
     *
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Sets message
     *
     * @param  string $message
     * @return self
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Gets method
     *
     * @return string
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * Sets method
     *
     * @param  string $method
     * @return self
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }
}
