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
 * IMAPItemInfo struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 */
class IMAPItemInfo
{
    /**
     * Message ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $id;

    /**
     * IMAP UID
     * 
     * @Accessor(getter="getImapUid", setter="setImapUid")
     * @SerializedName("i4uid")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getImapUid', setter: 'setImapUid')]
    #[SerializedName(name: 'i4uid')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $imapUid;

    /**
     * Constructor
     * 
     * @param  int $id Message ID
     * @param  int $imapUid IMAP UID
     * @return self
     */
    public function __construct(int $id = 0, int $imapUid = 0)
    {
        $this->setId($id)
             ->setImapUid($imapUid);
    }

    /**
     * Get Message ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set Message ID
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get IMAP UID
     *
     * @return int
     */
    public function getImapUid(): int
    {
        return $this->imapUid;
    }

    /**
     * Set IMAP UID
     *
     * @param  int $imapUid
     * @return self
     */
    public function setImapUid(int $imapUid): self
    {
        $this->imapUid = $imapUid;
        return $this;
    }
}
