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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
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
     * 
     * @var SearchRequest
     */
    #[Accessor(getter: "getSearchRequest", setter: "setSearchRequest")]
    #[SerializedName('SearchRequest')]
    #[Type(SearchRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $searchRequest;

    /**
     * Bulk action
     * 
     * @Accessor(getter="getBulkAction", setter="setBulkAction")
     * @SerializedName("BulkAction")
     * @Type("Zimbra\Mail\Struct\BulkAction")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var BulkAction
     */
    #[Accessor(getter: "getBulkAction", setter: "setBulkAction")]
    #[SerializedName('BulkAction')]
    #[Type(BulkAction::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $bulkAction;

    /**
     * Constructor
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SearchActionEnvelope(
            new SearchActionBody($this)
        );
    }
}
