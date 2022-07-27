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
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetAdminSavedSearchesResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAdminSavedSearchesResponse implements SoapResponseInterface
{
    /**
     * Information on saved searches
     * 
     * @Accessor(getter="getSearches", setter="setSearches")
     * @Type("array<Zimbra\Common\Struct\NamedValue>")
     * @XmlList(inline=true, entry="search", namespace="urn:zimbraAdmin")
     */
    private $searches = [];

    /**
     * Constructor method for GetAdminSavedSearchesResponse
     *
     * @param array $searches
     * @return self
     */
    public function __construct(array $searches = [])
    {
        $this->setSearches($searches);
    }

    /**
     * Add a saved search
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
     * Sets saved searches
     *
     * @param  array $searches
     * @return self
     */
    public function setSearches(array $searches): self
    {
        $this->searches = array_filter($searches, static fn ($search) => $search instanceof NamedValue);
        return $this;
    }

    /**
     * Gets saved searches
     *
     * @return array
     */
    public function getSearches(): array
    {
        return $this->searches;
    }
}
