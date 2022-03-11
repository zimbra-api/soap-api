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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Struct\NamedValue;
use Zimbra\Soap\Request;

/**
 * ModifyAdminSavedSearches request class
 * Modifies admin saved searches.
 * Returns the admin saved searches.
 * If {search-query} is empty => delete the search if it exists
 * If {search-name} already exists => replace with new {search-query}
 * If {search-name} does not exist => save as a new search
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyAdminSavedSearchesRequest extends Request
{
    /**
     * Search information
     * @Accessor(getter="getSearches", setter="setSearches")
     * @SerializedName("search")
     * @Type("array<Zimbra\Struct\NamedValue>")
     * @XmlList(inline = true, entry = "search")
     */
    private $searches;

    /**
     * Constructor method for ModifyAdminSavedSearchesRequest
     * 
     * @param array $searches
     * @return self
     */
    public function __construct(array $searches = [])
    {
        $this->setSearches($searches);
    }

    /**
     * Add a search
     *
     * @param  NamedValue $search
     * @return self
     */
    public function addSearch(NamedValue $search): self
    {
        $this->searches[] = $search;
        return $this;
    }

    /**
     * Sets searches
     *
     * @param array $searches
     * @return self
     */
    public function setSearches(array $searches): self
    {
        $this->searches = [];
        foreach ($searches as $search) {
            if ($search instanceof NamedValue) {
                $this->searches[] = $search;
            }
        }
        return $this;
    }

    /**
     * Gets searches
     *
     * @return array
     */
    public function getSearches(): ?array
    {
        return $this->searches;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyAdminSavedSearchesEnvelope)) {
            $this->envelope = new ModifyAdminSavedSearchesEnvelope(
                new ModifyAdminSavedSearchesBody($this)
            );
        }
    }
}
