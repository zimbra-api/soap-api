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
 * AccountQuotaInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="account")
 */
class AccountQuotaInfo
{
    /**
     * Account name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Account ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Used quota in bytes, or 0 if no quota used
     * @Accessor(getter="getQuotaUsed", setter="setQuotaUsed")
     * @SerializedName("used")
     * @Type("int")
     * @XmlAttribute
     */
    private $quotaUsed;

    /**
     * Quota limit in bytes, or 0 if unlimited
     * @Accessor(getter="getQuotaLimit", setter="setQuotaLimit")
     * @SerializedName("limit")
     * @Type("int")
     * @XmlAttribute
     */
    private $quotaLimit;

    /**
     * Constructor method for AccountQuotaInfo
     *
     * @param string $name
     * @param string $id
     * @param int $quotaUsed
     * @param int $quotaLimit
     * @return self
     */
    public function __construct(
        string $name,
        string $id,
        int $quotaUsed,
        int $quotaLimit
    )
    {
        $this->setName($name)
             ->setId($id)
             ->setQuotaUsed($quotaUsed)
             ->setQuotaLimit($quotaLimit);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $baseUrl
     * @return self
     */
    public function setName(string $baseUrl): self
    {
        $this->name = $baseUrl;
        return $this;
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
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

    /**
     * Gets quotaLimit
     *
     * @return int
     */
    public function getQuotaLimit(): int
    {
        return $this->quotaLimit;
    }

    /**
     * Sets quotaLimit
     *
     * @param  int $quotaLimit
     * @return self
     */
    public function setQuotaLimit(int $quotaLimit): self
    {
        $this->quotaLimit = $quotaLimit;
        return $this;
    }
}
