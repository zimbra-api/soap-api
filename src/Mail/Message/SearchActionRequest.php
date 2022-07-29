<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\BulkAction;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SearchActionRequest class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SearchActionRequest extends SoapRequest
{
    /**
     * Search request
     * 
     * @Accessor(getter="getSearchRequest", setter="setSearchRequest")
     * @SerializedName("SearchRequest")
     * @Type("Zimbra\Mail\Message\SearchRequest")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private SearchRequest $searchRequest;

    /**
     * Bulk action
     * 
     * @Accessor(getter="getBulkAction", setter="setBulkAction")
     * @SerializedName("BulkAction")
     * @Type("Zimbra\Mail\Struct\BulkAction")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private BulkAction $bulkAction;

    /**
     * Constructor method for SearchActionRequest
     *
     * @param  SearchRequest $searchRequest
     * @param  BulkAction $bulkAction
     * @return self
     */
    public function __construct(SearchRequest $searchRequest, BulkAction $bulkAction)
    {
        $this->setSearchRequest($searchRequest)
             ->setBulkAction($bulkAction);
    }

    /**
     * Get searchRequest
     *
     * @return SearchRequest
     */
    public function getSearchRequest(): SearchRequest
    {
        return $this->searchRequest;
    }

    /**
     * Set searchRequest
     *
     * @param  SearchRequest $searchRequest
     * @return self
     */
    public function setSearchRequest(SearchRequest $searchRequest): self
    {
        $this->searchRequest = $searchRequest;
        return $this;
    }

    /**
     * Get bulkAction
     *
     * @return BulkAction
     */
    public function getBulkAction(): BulkAction
    {
        return $this->bulkAction;
    }

    /**
     * Set bulkAction
     *
     * @param  BulkAction $bulkAction
     * @return self
     */
    public function setBulkAction(BulkAction $bulkAction): self
    {
        $this->bulkAction = $bulkAction;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SearchActionEnvelope(
            new SearchActionBody($this)
        );
    }
}
