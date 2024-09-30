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
 * MailboxQuotaInfo class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailboxQuotaInfo
{
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
     * Quota used
     *
     * @var int
     */
    #[Accessor(getter: "getQuotaUsed", setter: "setQuotaUsed")]
    #[SerializedName("used")]
    #[Type("int")]
    #[XmlAttribute]
    private $quotaUsed;

    /**
     * Constructor
     *
     * @param string $accountId
     * @param int $quotaUsed
     * @return self
     */
    public function __construct(string $accountId = "", int $quotaUsed = 0)
    {
        $this->setAccountId($accountId)->setQuotaUsed($quotaUsed);
    }

    /**
     * Get accountId
     *
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * Set accountId
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
     * Get quotaUsed
     *
     * @return int
     */
    public function getQuotaUsed(): int
    {
        return $this->quotaUsed;
    }

    /**
     * Set quotaUsed
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
