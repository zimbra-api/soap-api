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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * MimePartAttachSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MimePartAttachSpec extends AttachSpec
{
    /**
     * Message ID
     * 
     * @var string
     */
    #[Accessor(getter: 'getMessageId', setter: 'setMessageId')]
    #[SerializedName('mid')]
    #[Type('string')]
    #[XmlAttribute]
    private $messageId;

    /**
     * Part
     * 
     * @var string
     */
    #[Accessor(getter: 'getPart', setter: 'setPart')]
    #[SerializedName('part')]
    #[Type('string')]
    #[XmlAttribute]
    private $part;

    /**
     * Constructor
     * 
     * @param string $messageId
     * @param string $part
     * @param bool $optional
     * @return self
     */
    public function __construct(
        string $messageId = '', string $part = '', ?bool $optional = NULL
    )
    {
        parent::__construct($optional);
        $this->setMessageId($messageId)
             ->setPart($part);
    }

    /**
     * Get messageId
     *
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * Set messageId
     *
     * @param  string $messageId
     * @return self
     */
    public function setMessageId(string $messageId): self
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * Get the part
     *
     * @return string
     */
    public function getPart(): string
    {
        return $this->part;
    }

    /**
     * Set the part
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
