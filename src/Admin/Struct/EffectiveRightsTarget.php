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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EffectiveRightsTarget
{
    /**
     * Target type
     * 
     * @var TargetType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\TargetType>')]
    #[XmlAttribute]
    private $type;

    /**
     * Effective rights
     * 
     * @var EffectiveRightsInfo
     */
    #[Accessor(getter: 'getAll', setter: 'setAll')]
    #[SerializedName(name: 'all')]
    #[Type(name: EffectiveRightsInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $all;

    /**
     * In domains
     * 
     * @var array
     */
    #[Accessor(getter: 'getInDomainLists', setter: 'setInDomainLists')]
    #[Type(name: 'array<Zimbra\Admin\Struct\InDomainInfo>')]
    #[XmlList(inline: true, entry: 'inDomains', namespace: 'urn:zimbraAdmin')]
    private $inDomainLists = [];

    /**
     * Entries lists
     * 
     * @var array
     */
    #[Accessor(getter: 'getEntriesLists', setter: 'setEntriesLists')]
    #[Type(name: 'array<Zimbra\Admin\Struct\RightsEntriesInfo>')]
    #[XmlList(inline: true, entry: 'entries', namespace: 'urn:zimbraAdmin')]
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
        ?TargetType $type = NULL,
        ?EffectiveRightsInfo $all = NULL,
        array $inDomainLists = [],
        array $entriesLists = []
    )
    {
        $this->setType($type ?? TargetType::ACCOUNT)
             ->setInDomainLists($inDomainLists)
             ->setEntriesLists($entriesLists);
        if ($all instanceof EffectiveRightsInfo) {
            $this->setAll($all);
        }
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
