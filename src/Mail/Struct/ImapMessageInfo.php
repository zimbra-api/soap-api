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
 * ImapMessageInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 */
class ImapMessageInfo extends IMAPItemInfo
{
    /**
     * Item type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $type;

    /**
     * Flags
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("int")
     * @XmlAttribute
     */
    private $flags;

    /**
     * Comma separated list of name of tags associated with this item
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     */
    private $tags;

    /**
     * Constructor method for ImapMessageInfo
     * @param  int $id Message ID
     * @param  int $imapUid IMAP UID
     * @param  string $type IMAP UID
     * @param  int $flags IMAP UID
     * @param  string $tags IMAP UID
     * @return self
     */
    public function __construct(int $id, int $imapUid, string $type, int $flags, string $tags)
    {
        parent::__construct($id, $imapUid);
        $this->setType($type)
             ->setFlags($flags)
             ->setTags($tags);
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets flags
     *
     * @return int
     */
    public function getFlags(): int
    {
        return $this->flags;
    }

    /**
     * Sets flags
     *
     * @param  int $flags
     * @return self
     */
    public function setFlags(int$flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Gets tags
     *
     * @return string
     */
    public function getTags(): string
    {
        return $this->tags;
    }

    /**
     * Sets tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;
        return $this;
    }
}
