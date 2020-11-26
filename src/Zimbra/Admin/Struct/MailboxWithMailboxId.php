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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * MailboxWithMailboxId struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van 2020 - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="mbox")
 */
class MailboxWithMailboxId
{
    /**
     * Mailbox ID
     * @Accessor(getter="getMbxid", setter="setMbxid")
     * @SerializedName("mbxid")
     * @Type("integer")
     * @XmlAttribute
     */
    private $mbxid;

    /**
     * Account ID
     * @Accessor(getter="getAccountId", setter="setAccountId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $accountId;

    /**
     * Size in bytes
     * @Accessor(getter="getSize", setter="setSize")
     * @SerializedName("s")
     * @Type("integer")
     * @XmlAttribute
     */
    private $size;

    /**
     * Constructor method for MailboxWithMailboxId
     * @param int $mbxid
     * @param string $accountId
     * @param int $size
     * @return self
     */
    public function __construct(int $mbxid, string $accountId, ?int $size = NULL)
    {
        $this->setMbxid($mbxid)
             ->setAccountId($accountId);
        if (NULL !== $size) {
            $this->setSize($size);
        }
    }

    /**
     * Gets mbxid
     *
     * @return int
     */
    public function getMbxid(): int
    {
        return $this->mbxid;
    }

    /**
     * Sets the mbxid
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
     * Gets the account ID
     *
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Sets the account ID
     *
     * @param  string $accountId
     * @return self
     */
    public function setAccountId(string $accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * Gets the size
     *
     * @return int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Sets the size
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
