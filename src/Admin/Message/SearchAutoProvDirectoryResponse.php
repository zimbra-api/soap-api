<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Admin\Struct\AutoProvDirectoryEntry;
use Zimbra\Common\Struct\SoapResponse;

/**
 * SearchAutoProvDirectoryResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchAutoProvDirectoryResponse extends SoapResponse
{
    /**
     * 1 (true) if more entries to return
     * 
     * @var bool
     */
    #[Accessor(getter: 'getMore', setter: 'setMore')]
    #[SerializedName('more')]
    #[Type('bool')]
    #[XmlAttribute]
    private $more;

    /**
     * Total number of accounts that matched search (not affected by limit/offset)
     * 
     * @var int
     */
    #[Accessor(getter: 'getSearchTotal', setter: 'setSearchTotal')]
    #[SerializedName('searchTotal')]
    #[Type('int')]
    #[XmlAttribute]
    private $searchTotal;

    /**
     * Entries
     * 
     * @var array
     */
    #[Accessor(getter: 'getEntries', setter: 'setEntries')]
    #[Type('array<Zimbra\Admin\Struct\AutoProvDirectoryEntry>')]
    #[XmlList(inline: true, entry: 'entry', namespace: 'urn:zimbraAdmin')]
    private $entries = [];

    /**
     * Constructor
     *
     * @param bool $more
     * @param int $searchTotal
     * @param array $entries
     * @return self
     */
    public function __construct(
        bool $more = false,
        int $searchTotal = 0,
        array $entries = []
    )
    {
        $this->setMore($more)
             ->setSearchTotal($searchTotal)
             ->setEntries($entries);
    }

    /**
     * Get more
     *
     * @return bool
     */
    public function getMore(): bool
    {
        return $this->more;
    }

    /**
     * Set more
     *
     * @param  bool $more
     * @return self
     */
    public function setMore(bool $more): self
    {
        $this->more = $more;
        return $this;
    }

    /**
     * Get searchTotal
     *
     * @return int
     */
    public function getSearchTotal(): int
    {
        return $this->searchTotal;
    }

    /**
     * Set searchTotal
     *
     * @param  int $searchTotal
     * @return self
     */
    public function setSearchTotal(int $searchTotal): self
    {
        $this->searchTotal = $searchTotal;
        return $this;
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
            $entries, static fn ($entry) => $entry instanceof AutoProvDirectoryEntry
        );
        return $this;
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
}
