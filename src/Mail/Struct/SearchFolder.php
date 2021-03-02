<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\SearchSortBy;
use Zimbra\Enum\ItemType;

/**
 * SearchFolder struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="search")
 */
class SearchFolder extends Folder
{
    /**
     * Query
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("string")
     * @XmlAttribute
     */
    private $query;

    /**
     * Sort by
     * @Accessor(getter="getSortBy", setter="setSortBy")
     * @SerializedName("sortBy")
     * @Type("Zimbra\Enum\SearchSortBy")
     * @XmlAttribute
     */
    private $sortBy;

    /**
     * Comma-separated list.  Legal values in list are:
     * appointment|chat|contact|conversation|document|message|tag|task|wiki
     * @Accessor(getter="getTypes", setter="setTypes")
     * @SerializedName("types")
     * @Type("string")
     * @XmlAttribute
     */
    private $types;

    /**
     * Constructor method for SearchFolder
     * 
     * @param  string $id
     * @param  string $uuid
     * @return self
     */
    public function __construct(
        string $id,
        string $uuid
    )
    {
    	parent::__construct($id, $uuid);
    }

    /**
     * Gets query
     *
     * @return string
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * Sets query
     *
     * @param  string $query
     * @return self
     */
    public function setQuery(string $query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Gets sortBy
     *
     * @return SearchSortBy
     */
    public function getSortBy(): ?SearchSortBy
    {
        return $this->sortBy;
    }

    /**
     * Sets sortBy
     *
     * @param  SearchSortBy $sortBy
     * @return self
     */
    public function setSortBy(SearchSortBy $sortBy)
    {
        $this->sortBy = $sortBy;
        return $this;
    }

    /**
     * Gets types
     *
     * @return string
     */
    public function getTypes(): ?string
    {
        return $this->types;
    }

    /**
     * Sets types
     *
     * @param  string $types
     * @return self
     */
    public function setTypes(string $types)
    {
        $validTypes = [];
        foreach (explode(',', $types) as $type) {
            if (ItemType::isValid($type) && !in_array($type, $validTypes)) {
                $validTypes[] = $right;
            }
        }
        $this->types = implode(',', $validTypes);
        return $this;
    }
}
