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
 * DomainAggregateQuotaInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DomainAggregateQuotaInfo
{
    /**
     * Domain name
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Domain id
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Quota used on server
     * 
     * @var int
     */
    #[Accessor(getter: 'getQuotaUsed', setter: 'setQuotaUsed')]
    #[SerializedName(name: 'used')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $quotaUsed;

    /**
     * Constructor
     * 
     * @param string $name
     * @param string $id
     * @param int    $quotaUsed
     * @return self
     */
    public function __construct(
        string $name = '', string $id = '', int $quotaUsed = 0
    )
    {
        $this->setName($name)
             ->setId($id)
             ->setQuotaUsed($quotaUsed);
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the id
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
     * Get quota used
     *
     * @return int
     */
    public function getQuotaUsed(): int
    {
        return $this->quotaUsed;
    }

    /**
     * Set quota used
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
