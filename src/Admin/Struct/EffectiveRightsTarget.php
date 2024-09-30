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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Common\Enum\TargetType;

/**
 * EffectiveRightsTarget struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EffectiveRightsTarget
{
    /**
     * Target type
     *
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Enum<Zimbra\Common\Enum\TargetType>")
     * @XmlAttribute
     *
     * @var TargetType
     */
    #[Accessor(getter: "getType", setter: "setType")]
    #[SerializedName("type")]
    #[Type("Enum<Zimbra\Common\Enum\TargetType>")]
    #[XmlAttribute]
    private TargetType $type;

    /**
     * Effective rights
     *
     * @Accessor(getter="getAll", setter="setAll")
     * @SerializedName("all")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var EffectiveRightsInfo
     */
    #[Accessor(getter: "getAll", setter: "setAll")]
    #[SerializedName("all")]
    #[Type(EffectiveRightsInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?EffectiveRightsInfo $all;

    /**
     * In domains
     *
     * @Accessor(getter="getInDomainLists", setter="setInDomainLists")
     * @Type("array<Zimbra\Admin\Struct\InDomainInfo>")
     * @XmlList(inline=true, entry="inDomains", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getInDomainLists", setter: "setInDomainLists")]
    #[Type("array<Zimbra\Admin\Struct\InDomainInfo>")]
    #[XmlList(inline: true, entry: "inDomains", namespace: "urn:zimbraAdmin")]
    private $inDomainLists = [];

    /**
     * Entries lists
     *
     * @Accessor(getter="getEntriesLists", setter="setEntriesLists")
     * @Type("array<Zimbra\Admin\Struct\RightsEntriesInfo>")
     * @XmlList(inline=true, entry="entries", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getEntriesLists", setter: "setEntriesLists")]
    #[Type("array<Zimbra\Admin\Struct\RightsEntriesInfo>")]
    #[XmlList(inline: true, entry: "entries", namespace: "urn:zimbraAdmin")]
    private $entriesLists = [];

    /**
     * Constructor
     *
     * @param TargetType $type
     * @param EffectiveRightsInfo $all
     * @param array $inDomainLists
     * @param array $entriesLists
     * @return self
     */
    public function __construct(
        ?TargetType $type = null,
        ?EffectiveRightsInfo $all = null,
        array $inDomainLists = [],
        array $entriesLists = []
    ) {
        $this->setType($type ?? new TargetType("account"))
            ->setInDomainLists($inDomainLists)
            ->setEntriesLists($entriesLists);
        $this->all = $all;
    }

    /**
     * Set Target type
     *
     * @return TargetType
     */
    public function getType(): TargetType
    {
        return $this->type;
    }

    /**
     * Set Target type
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
     * Set Effective rights
     *
     * @return EffectiveRightsInfo
     */
    public function getAll(): ?EffectiveRightsInfo
    {
        return $this->all;
    }

    /**
     * Set Effective rights
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
     * Get inDomainLists
     *
     * @return array
     */
    public function getInDomainLists(): array
    {
        return $this->inDomainLists;
    }

    /**
     * Set inDomainLists
     *
     * @param  array $lists
     * @return self
     */
    public function setInDomainLists(array $lists): self
    {
        $this->inDomainLists = array_filter(
            $lists,
            static fn($item) => $item instanceof InDomainInfo
        );
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
     * Get entriesLists
     *
     * @return array
     */
    public function getEntriesLists(): array
    {
        return $this->entriesLists;
    }

    /**
     * Set entriesLists
     *
     * @param  array $lists
     * @return self
     */
    public function setEntriesLists(array $lists): self
    {
        $this->entriesLists = array_filter(
            $lists,
            static fn($item) => $item instanceof RightsEntriesInfo
        );
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
