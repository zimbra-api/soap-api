<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyentry and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlList
};
use Zimbra\Common\Struct\NamedElement;

/**
 * RightsEntriesInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RightsEntriesInfo
{
    /**
     * Entries
     *
     * @var array
     */
    #[Accessor(getter: "getEntries", setter: "setEntries")]
    #[Type("array<Zimbra\Common\Struct\NamedElement>")]
    #[XmlList(inline: true, entry: "entry", namespace: "urn:zimbraAdmin")]
    private $entries = [];

    /**
     * Effective rights
     *
     * @var EffectiveRightsInfo
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[SerializedName("rights")]
    #[Type(EffectiveRightsInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private EffectiveRightsInfo $rights;

    /**
     * Constructor
     *
     * @param EffectiveRightsInfo $rights
     * @param array $entries
     * @return self
     */
    public function __construct(
        EffectiveRightsInfo $rights,
        array $entries = []
    ) {
        $this->setRights($rights)->setEntries($entries);
    }
    /**
     * Get entries
     *
     * @return array
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * Set entries
     *
     * @param  array $entries
     * @return self
     */
    public function setEntries(array $entries): self
    {
        $this->entries = array_filter(
            $entries,
            static fn($entry) => $entry instanceof NamedElement
        );
        return $this;
    }

    /**
     * Adds an entry
     *
     * @param  NamedElement $entry
     * @return self
     */
    public function addEntry(NamedElement $entry): self
    {
        $this->entries[] = $entry;
        return $this;
    }

    /**
     * Get rights
     *
     * @return EffectiveRightsInfo
     */
    public function getRights(): EffectiveRightsInfo
    {
        return $this->rights;
    }

    /**
     * Set rights
     *
     * @param  EffectiveRightsInfo $rights
     * @return self
     */
    public function setRights(EffectiveRightsInfo $rights): self
    {
        $this->rights = $rights;
        return $this;
    }
}
