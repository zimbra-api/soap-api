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
 * NewSearchFolderSpec class
 * Input for creating a new search folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class NewSearchFolderSpec
{
    /**
     * Name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName('name')]
    #[Type('string')]
    #[XmlAttribute]
    private $name;

    /**
     * query
     * 
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getQuery', setter: 'setQuery')]
    #[SerializedName('query')]
    #[Type('string')]
    #[XmlAttribute]
    private $query;

    /**
     * Search types
     * 
     * @Accessor(getter="getSearchTypes", setter="setSearchTypes")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getSearchTypes', setter: 'setSearchTypes')]
    #[SerializedName('types')]
    #[Type('string')]
    #[XmlAttribute]
    private $searchTypes;

    /**
     * Sort by
     * 
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("Enum<Zimbra\Common\Enum\SearchSortBy>")
     * @XmlAttribute
     * 
     * @var SearchSortBy
     */
    #[Accessor(getter: 'getSortBy', setter: 'setSortBy')]
    #[SerializedName('sortBy')]
    #[Type('Enum<Zimbra\Common\Enum\SearchSortBy>')]
    #[XmlAttribute]
    private ?SearchSortBy $sortBy;

    /**
     * Flags
     * 
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getFlags', setter: 'setFlags')]
    #[SerializedName('f')]
    #[Type('string')]
    #[XmlAttribute]
    private $flags;

    /**
     * color numeric; range 0-127; defaults to 0 if not present; client can display only 0-7
     * 
     * @Accessor(getter="getColor", setter="setColor")
     * @SerializedName("color")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getColor', setter: 'setColor')]
    #[SerializedName('color')]
    #[Type('int')]
    #[XmlAttribute]
    private $color;

    /**
     * RGB color in format #rrggbb where r,g and b are hex digits
     * 
     * @Accessor(getter="getRgb", setter="setRgb")
     * @SerializedName("rgb")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getRgb', setter: 'setRgb')]
    #[SerializedName('rgb')]
    #[Type('string')]
    #[XmlAttribute]
    private $rgb;

    /**
     * Parent folder ID
     * 
     * @Accessor(getter="getParentFolderId", setter="setParentFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getParentFolderId', setter: 'setParentFolderId')]
    #[SerializedName('l')]
    #[Type('string')]
    #[XmlAttribute]
    private $parentFolderId;

    /**
     * Constructor
     *
     * @param  string $name
     * @param  string $query
     * @param  string $searchTypes
     * @param  SearchSortBy $sortBy
     * @param  string $flags
     * @param  int $color
     * @param  string $rgb
     * @param  string $parentFolderId
     * @return self
     */
    public function __construct(
        string $name = '',
        string $query = '',
        ?string $searchTypes = NULL,
        ?SearchSortBy $sortBy = NULL,
        ?string $flags = NULL,
        ?int $color = NULL,
        ?string $rgb = NULL,
        ?string $parentFolderId = NULL
    )
    {
        $this->setName($name)
             ->setQuery($query);
        $this->sortBy = $sortBy;
        if (NULL !== $searchTypes) {
            $this->setSearchTypes($searchTypes);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $color) {
            $this->setColor($color);
        }
        if (NULL !== $rgb) {
            $this->setRgb($rgb);
        }
        if (NULL !== $parentFolderId) {
            $this->setParentFolderId($parentFolderId);
        }
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
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
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

    /**
     * Get parentFolderId
     *
     * @return string
     */
    public function getParentFolderId(): ?string
    {
        return $this->parentFolderId;
    }

    /**
     * Set parentFolderId
     *
     * @param  string $parentFolderId
     * @return self
     */
    public function setParentFolderId(string $parentFolderId): self
    {
        $this->parentFolderId = $parentFolderId;
        return $this;
    }

    /**
     * Get flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Set flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags(string $flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Get color
     *
     * @return int
     */
    public function getColor(): ?int
    {
        return $this->color;
    }

    /**
     * Set color
     *
     * @param  int $color
     * @return self
     */
    public function setColor(int $color): self
    {
        $this->color = in_array($color, range(0, 127)) ? $color : 0;
        return $this;
    }

    /**
     * Get rgb
     *
     * @return string
     */
    public function getRgb(): ?string
    {
        return $this->rgb;
    }

    /**
     * Set rgb
     *
     * @param  string $rgb
     * @return self
     */
    public function setRgb(string $rgb): self
    {
        $this->rgb = $rgb;
        return $this;
    }
}
