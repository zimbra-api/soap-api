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
 * DomainAggregateQuotaInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="domain")
 */
class DomainAggregateQuotaInfo
{
    /**
     * Domain name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Domain id
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Quota used on server
     * @Accessor(getter="getQuotaUsed", setter="setQuotaUsed")
     * @SerializedName("used")
     * @Type("int")
     * @XmlAttribute
     */
    private $quotaUsed;

    /**
     * Constructor method for DomainAggregateQuotaInfo
     * @param string $name
     * @param string $id
     * @param int   $quotaUsed
     * @return self
     */
    public function __construct($name, $id, $quotaUsed)
    {
        $this->setName($name)
             ->setId($id)
             ->setQuotaUsed($quotaUsed);
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets the id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets the id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets quota used
     *
     * @return int
     */
    public function getQuotaUsed(): int
    {
        return $this->quotaUsed;
    }

    /**
     * Sets quota used
     *
     * @param  int $quotaUsed
     * @return self
     */
    public function setQuotaUsed($quotaUsed): self
    {
        $this->quotaUsed = (int) $quotaUsed;
        return $this;
    }
}
