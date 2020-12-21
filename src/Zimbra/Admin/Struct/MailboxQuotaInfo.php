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
 * MailboxQuotaInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="mbox")
 */
class MailboxQuotaInfo
{
    /**
     * Account ID
     * @Accessor(getter="getAccountId", setter="setAccountId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $accountId;

    /**
     * Quota used
     * @Accessor(getter="getQuotaUsed", setter="setQuotaUsed")
     * @SerializedName("used")
     * @Type("int")
     * @XmlAttribute
     */
    private $quotaUsed;

    /**
     * Constructor method for MailboxQuotaInfo
     *
     * @param string $accountId
     * @param int $quotaUsed
     * @return self
     */
    public function __construct(
        string $accountId,
        int $quotaUsed
    )
    {
        $this->setAccountId($accountId)
             ->setQuotaUsed($quotaUsed);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setAccountId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets quotaUsed
     *
     * @return int
     */
    public function getQuotaUsed(): int
    {
        return $this->quotaUsed;
    }

    /**
     * Sets quotaUsed
     *
     * @param  int $quotaUsed
     * @return self
     */
    public function setQuotaUsed(int $quotaUsed): self
    {
        $this->quotaUsed = $quotaUsed;
        return $this;
    }
}
