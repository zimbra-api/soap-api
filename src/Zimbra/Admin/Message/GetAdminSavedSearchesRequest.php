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
use Zimbra\Struct\NamedElement;
use Zimbra\Soap\Request;

/**
 * GetAdminSavedSearches request class
 * Clear cookie
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAdminSavedSearchesRequest")
 */
class GetAdminSavedSearchesRequest extends Request
{
    /**
     * Search information
     * @Accessor(getter="getSearches", setter="setSearches")
     * @SerializedName("search")
     * @Type("array<Zimbra\Struct\NamedElement>")
     * @XmlList(inline = true, entry = "search")
     */
    private $searches;

    /**
     * Constructor method for GetAdminSavedSearchesRequest
     * 
     * @param array  $searches
     * @return self
     */
    public function __construct(array $searches = [])
    {
        $this->setSearches($searches);
    }

    /**
     * Add a search
     *
     * @param  NamedElement $search
     * @return self
     */
    public function addSearch(NamedElement $search): self
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
            if ($search instanceof NamedElement) {
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
        if (!($this->envelope instanceof GetAdminSavedSearchesEnvelope)) {
            $this->envelope = new GetAdminSavedSearchesEnvelope(
                new GetAdminSavedSearchesBody($this)
            );
        }
    }
}
