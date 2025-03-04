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
     *
     * @var string
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("t")]
    #[Type("string")]
    #[XmlAttribute]
    private string $type;

    /**
     * Flags
     *
     * @var int
     */
    #[Accessor(getter: "getFlags", setter: "setFlags")]
    #[SerializedName("f")]
    #[Type("int")]
    #[XmlAttribute]
    private int $flags;

    /**
     * Comma separated list of name of tags associated with this item
     *
     * @var string
     */
    #[Accessor(getter: "getTags", setter: "setTags")]
    #[SerializedName("tn")]
    #[Type("string")]
    #[XmlAttribute]
    private string $tags;

    /**
     * Constructor
     *
     * @param  int $id Message ID
     * @param  int $imapUid IMAP UID
     * @param  string $type IMAP UID
     * @param  int $flags IMAP UID
     * @param  string $tags IMAP UID
     * @return self
     */
    public function __construct(
        int $id = 0,
        int $imapUid = 0,
        string $type = "",
        int $flags = 0,
        string $tags = ""
    ) {
        parent::__construct($id, $imapUid);
        $this->setType($type)->setFlags($flags)->setTags($tags);
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set type
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
     * Get flags
     *
     * @return int
     */
    public function getFlags(): int
    {
        return $this->flags;
    }

    /**
     * Set flags
     *
     * @param  int $flags
     * @return self
     */
    public function setFlags(int $flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags(): string
    {
        return $this->tags;
    }

    /**
     * Set tags
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
