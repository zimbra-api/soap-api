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
use Zimbra\Common\Struct\{NamedElement, SoapEnvelopeInterface, SoapRequest};

/**
 * GetAdminSavedSearches request class
 * Returns admin saved searches. 
 * If no <search> is present server will return all saved searches.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAdminSavedSearchesRequest extends SoapRequest
{
    /**
     * Search information
     * 
     * @var array
     */
    #[Accessor(getter: 'getSearches', setter: 'setSearches')]
    #[Type('array<Zimbra\Common\Struct\NamedElement>')]
    #[XmlList(inline: true, entry: 'search', namespace: 'urn:zimbraAdmin')]
    private $searches = [];

    /**
     * Constructor
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
     * @param  NamedElement $search
     * @return self
     */
    public function addSearch(NamedElement $search): self
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
        $this->searches = array_filter(
            $searches, static fn ($search) => $search instanceof NamedElement
        );
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAdminSavedSearchesEnvelope(
            new GetAdminSavedSearchesBody($this)
        );
    }
}
