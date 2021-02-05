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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * MimePartAttachSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="mp")
 */
class MimePartAttachSpec extends AttachSpec
{
    /**
     * Message ID
     * @Accessor(getter="getMessageId", setter="setMessageId")
     * @SerializedName("mid")
     * @Type("string")
     * @XmlAttribute
     */
    private $messageId;

    /**
     * Part
     * @Accessor(getter="getPart", setter="setPart")
     * @SerializedName("part")
     * @Type("string")
     * @XmlAttribute
     */
    private $part;

    /**
     * Constructor method
     * 
     * @param string $messageId
     * @param string $part
     * @param bool $optional
     * @return self
     */
    public function __construct(string $messageId, string $part, ?bool $optional = NULL)
    {
        parent::__construct($optional);
        $this->setMessageId($messageId)
             ->setPart($part);
    }

    /**
     * Gets messageId
     *
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * Sets messageId
     *
     * @param  string $type
     * @return self
     */
    public function setMessageId(string $messageId): self
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * Gets the part
     *
     * @return string
     */
    public function getPart(): string
    {
        return $this->part;
    }

    /**
     * Sets the part
     *
     * @param  string $part
     * @return self
     */
    public function setPart(string $part): self
    {
        $this->part = $part;
        return $this;
    }
}