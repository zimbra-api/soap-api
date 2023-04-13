<?php declare(strict_types=1);
/**
 * This file is name of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\{ItemType, SearchSortBy};

/**
 * ModifySearchFolderSpec class
 * Input for modifying an existing search folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifySearchFolderSpec
{
    /**
     * Search folder id to be edited
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * New search query
     * 
     * @var string
     */
    #[Accessor(getter: 'getQuery', setter: 'setQuery')]
    #[SerializedName('query')]
    #[Type('string')]
    #[XmlAttribute]
    private $query;

    /**
     * New type for the search folder
     * 
     * @var string
     */
    #[Accessor(getter: 'getSearchTypes', setter: 'setSearchTypes')]
    #[SerializedName('types')]
    #[Type('string')]
    #[XmlAttribute]
    private $searchTypes;

    /**
     * New sort order for
     * 
     * @var SearchSortBy
     */
    #[Accessor(getter: 'getSortBy', setter: 'setSortBy')]
    #[SerializedName('sortBy')]
    #[Type('Enum<Zimbra\Common\Enum\SearchSortBy>')]
    #[XmlAttribute]
    private ?SearchSortBy $sortBy;

    /**
     * Constructor
     *
     * @param  string $id
     * @param  string $query
     * @param  string $searchTypes
     * @param  SearchSortBy $sortBy
     * @return self
     */
    public function __construct(
        string $id = '',
        string $query = '',
        ?string $searchTypes = NULL,
        ?SearchSortBy $sortBy = NULL
    )
    {
        $this->setId($id)
             ->setQuery($query);
        $this->sortBy = $sortBy;
        if (NULL !== $searchTypes) {
            $this->setSearchTypes($searchTypes);
        }
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
     * Get query
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Set query
     *
     * @param  string $query
     * @return self
     */
    public function setQuery(string $query): self
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Get searchTypes
     *
     * @return string
     */
    public function getSearchTypes(): ?string
    {
        return $this->searchTypes;
    }

    /**
     * Set searchTypes
     *
     * @param  string $searchTypes
     * @return self
     */
    public function setSearchTypes(string $searchTypes): self
    {
        $validTypes = [];
        foreach (explode(',', $searchTypes) as $type) {
            if (ItemType::isValid($type) && !in_array($type, $validTypes)) {
                $validTypes[] = $type;
            }
        }
        $this->searchTypes = implode(',', $validTypes);
        return $this;
    }

    /**
     * Get sortBy
     *
     * @return SearchSortBy
     */
    public function getSortBy(): ?SearchSortBy
    {
        return $this->sortBy;
    }

    /**
     * Set sortBy
     *
     * @param  SearchSortBy $sortBy
     * @return self
     */
    public function setSortBy(SearchSortBy $sortBy): self
    {
        $this->sortBy = $sortBy;
        return $this;
    }
}
