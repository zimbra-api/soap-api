<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * MailboxWithMailboxId struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van 2020 - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailboxWithMailboxId
{
    /**
     * Mailbox ID
     *
     * @var int
     */
    #[Accessor(getter: "getMbxid", setter: "setMbxid")]
    #[SerializedName("mbxid")]
    #[Type("int")]
    #[XmlAttribute]
    private $mbxid;

    /**
     * Account ID
     *
     * @var string
     */
    #[Accessor(getter: "getAccountId", setter: "setAccountId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private $accountId;

    /**
     * Size in bytes
     *
     * @var int
     */
    #[Accessor(getter: "getSize", setter: "setSize")]
    #[SerializedName("s")]
    #[Type("int")]
    #[XmlAttribute]
    private $size;

    /**
     * Constructor
     *
     * @param int $mbxid
     * @param string $accountId
     * @param int $size
     * @return self
     */
    public function __construct(
        int $mbxid = 0,
        string $accountId = "",
        ?int $size = null
    ) {
        $this->setMbxid($mbxid)->setAccountId($accountId);
        if (null !== $size) {
            $this->setSize($size);
        }
    }

    /**
     * Get mbxid
     *
     * @return int
     */
    public function getMbxid(): int
    {
        return $this->mbxid;
    }

    /**
     * Set the mbxid
     *
     * @param  int $mbxid
     * @return self
     */
    public function setMbxid(int $mbxid): self
    {
        $this->mbxid = $mbxid;
        return $this;
    }

    /**
     * Get the account ID
     *
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * Set the account ID
     *
     * @param  string $accountId
     * @return self
     */
    public function setAccountId(string $accountId): self
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * Get the size
     *
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Set the size
     *
     * @param  int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }
}
