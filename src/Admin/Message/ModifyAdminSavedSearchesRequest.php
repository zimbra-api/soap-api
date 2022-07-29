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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Common\Struct\NamedValue;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
class ModifyAdminSavedSearchesRequest extends SoapRequest
{
    /**
     * Search information
     * @Accessor(getter="getSearches", setter="setSearches")
     * @Type("array<Zimbra\Common\Struct\NamedValue>")
     * @XmlList(inline=true, entry="search", namespace="urn:zimbraAdmin")
     */
    private $searches = [];

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
     * Set searches
     *
     * @param array $searches
     * @return self
     */
    public function setSearches(array $searches): self
    {
        $this->searches = array_filter($searches, static fn ($search) => $search instanceof NamedValue);
        return $this;
    }

    /**
     * Get searches
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
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyAdminSavedSearchesEnvelope(
            new ModifyAdminSavedSearchesBody($this)
        );
    }
}
