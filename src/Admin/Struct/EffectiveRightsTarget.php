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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Enum\TargetType;

/**
 * EffectiveRightsTarget struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class EffectiveRightsTarget
{
    /**
     * Target type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\TargetType")
     * @XmlAttribute
     */
    private TargetType $type;

    /**
     * Effective rights
     * @Accessor(getter="getAll", setter="setAll")
     * @SerializedName("all")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?EffectiveRightsInfo $all = NULL;

    /**
     * Attributes
     * @Accessor(getter="getInDomainLists", setter="setInDomainLists")
     * @SerializedName("inDomains")
     * @Type("array<Zimbra\Admin\Struct\InDomainInfo>")
     * @XmlList(inline=true, entry="inDomains", namespace="urn:zimbraAdmin")
     */
    private $inDomainLists = [];

    /**
     * Attributes
     * @Accessor(getter="getEntriesLists", setter="setEntriesLists")
     * @SerializedName("entries")
     * @Type("array<Zimbra\Admin\Struct\RightsEntriesInfo>")
     * @XmlList(inline=true, entry="entries", namespace="urn:zimbraAdmin")
     */
    private $entriesLists = [];

    /**
     * Constructor method for EffectiveRightsTarget
     * @param TargetType $type
     * @param EffectiveRightsInfo $all
     * @param array $inDomainLists
     * @param array $entriesLists
     * @return self
     */
    public function __construct(
        TargetType $type,
        ?EffectiveRightsInfo $all = NULL,
        array $inDomainLists = [],
        array $entriesLists = []
    )
    {
        $this->setType($type)
             ->setInDomainLists($inDomainLists)
             ->setEntriesLists($entriesLists);
        if ($all instanceof EffectiveRightsInfo) {
            $this->setAll($all);
        }
    }

    /**
     * Sets Target type
     *
     * @return TargetType
     */
    public function getType(): TargetType
    {
        return $this->type;
    }

    /**
     * Sets Target type
     *
     * @param  TargetType $type
     * @return self
     */
    public function setType(TargetType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Sets Effective rights
     *
     * @return EffectiveRightsInfo
     */
    public function getAll(): ?EffectiveRightsInfo
    {
        return $this->all;
    }

    /**
     * Sets Effective rights
     *
     * @param  EffectiveRightsInfo $all
     * @return self
     */
    public function setAll(EffectiveRightsInfo $all): self
    {
        $this->all = $all;
        return $this;
    }

    /**
     * Gets inDomainLists
     *
     * @return array
     */
    public function getInDomainLists(): array
    {
        return $this->inDomainLists;
    }

    /**
     * Sets inDomainLists
     *
     * @param  array $lists
     * @return self
     */
    public function setInDomainLists(array $lists): self
    {
        $this->inDomainLists = array_filter($lists, static fn ($item) => $item instanceof InDomainInfo);
        return $this;
    }

    /**
     * Adds InDomainList
     *
     * @param  InDomainInfo $inDomainList
     * @return self
     */
    public function addInDomainList(InDomainInfo $inDomainList): self
    {
        $this->inDomainLists[] = $inDomainList;
        return $this;
    }

    /**
     * Gets entriesLists
     *
     * @return array
     */
    public function getEntriesLists(): array
    {
        return $this->entriesLists;
    }

    /**
     * Sets entriesLists
     *
     * @param  array $lists
     * @return self
     */
    public function setEntriesLists(array $lists): self
    {
        $this->entriesLists = array_filter($lists, static fn ($item) => $item instanceof RightsEntriesInfo);
        return $this;
    }

    /**
     * Adds InDomainList
     *
     * @param  RightsEntriesInfo $entriesList
     * @return self
     */
    public function addEntriesList(RightsEntriesInfo $entriesList): self
    {
        $this->entriesLists[] = $entriesList;
        return $this;
    }
}
