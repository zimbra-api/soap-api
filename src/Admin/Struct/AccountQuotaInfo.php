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
 * AccountQuotaInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountQuotaInfo
{
    /**
     * Account name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Account ID
     * 
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Used quota in bytes, or 0 if no quota used
     * 
     * @Accessor(getter="getQuotaUsed", setter="setQuotaUsed")
     * @SerializedName("used")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getQuotaUsed', setter: 'setQuotaUsed')]
    #[SerializedName(name: 'used')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $quotaUsed;

    /**
     * Quota limit in bytes, or 0 if unlimited
     * 
     * @Accessor(getter="getQuotaLimit", setter="setQuotaLimit")
     * @SerializedName("limit")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getQuotaLimit', setter: 'setQuotaLimit')]
    #[SerializedName(name: 'limit')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $quotaLimit;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $id
     * @param int $quotaUsed
     * @param int $quotaLimit
     * @return self
     */
    public function __construct(
        string $name = '',
        string $id = '',
        int $quotaUsed = 0,
        int $quotaLimit = 0
    )
    {
        $this->setName($name)
             ->setId($id)
             ->setQuotaUsed($quotaUsed)
             ->setQuotaLimit($quotaLimit);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set id
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

    /**
     * Get quotaLimit
     *
     * @return int
     */
    public function getQuotaLimit(): int
    {
        return $this->quotaLimit;
    }

    /**
     * Set quotaLimit
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
