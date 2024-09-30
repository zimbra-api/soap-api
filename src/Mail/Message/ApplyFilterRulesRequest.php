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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlElement,
    XmlList
};
use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Common\Struct\{NamedElement, SoapEnvelopeInterface, SoapRequest};

/**
 * ApplyFilterRulesRequest class
 * Applies one or more filter rules to messages specified by a comma-separated ID list,
 * or returned by a search query.  One or the other can be specified, but not both.  Returns the list of ids of
 * existing messages that were affected.
 *
 * Note that redirect actions are ignored when applying filter rules to existing messages.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ApplyFilterRulesRequest extends SoapRequest
{
    /**
     * Filter rules
     *
     * @Accessor(getter="getFilterRules", setter="setFilterRules")
     * @SerializedName("filterRules")
     * @Type("array<Zimbra\Common\Struct\NamedElement>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="filterRule", namespace="urn:zimbraMail")
     *
     * @var array
     */
    #[Accessor(getter: "getFilterRules", setter: "setFilterRules")]
    #[SerializedName("filterRules")]
    #[Type("array<Zimbra\Common\Struct\NamedElement>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "filterRule", namespace: "urn:zimbraMail")]
    private $filterRules = [];

    /**
     * Comma-separated list of message IDs
     *
     * @Accessor(getter="getMsgIds", setter="setMsgIds")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\IdsAttr")
     * @XmlElement(namespace="urn:zimbraMail")
     *
     * @var IdsAttr
     */
    #[Accessor(getter: "getMsgIds", setter: "setMsgIds")]
    #[SerializedName("m")]
    #[Type(IdsAttr::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?IdsAttr $msgIds;

    /**
     * Query string
     *
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraMail")
     *
     * @var string
     */
    #[Accessor(getter: "getQuery", setter: "setQuery")]
    #[SerializedName("query")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private $query;

    /**
     * Constructor
     *
     * @param  array $filterRules
     * @param  IdsAttr $msgIds
     * @param  string $query
     * @return self
     */
    public function __construct(
        array $filterRules = [],
        ?IdsAttr $msgIds = null,
        ?string $query = null
    ) {
        $this->setFilterRules($filterRules);
        $this->msgIds = $msgIds;
        if (null !== $query) {
            $this->setQuery($query);
        }
    }

    /**
     * Add filterRule
     *
     * @param  NamedElement $filterRule
     * @return self
     */
    public function addFilterRule(NamedElement $filterRule): self
    {
        $this->filterRules[] = $filterRule;
        return $this;
    }

    /**
     * Set filterRules
     *
     * @param  array $rules
     * @return self
     */
    public function setFilterRules(array $rules): self
    {
        $this->filterRules = array_filter(
            $rules,
            static fn($rule) => $rule instanceof NamedElement
        );
        return $this;
    }

    /**
     * Get filterRules
     *
     * @return array
     */
    public function getFilterRules(): array
    {
        return $this->filterRules;
    }

    /**
     * Get query
     *
     * @return string
     */
    public function getQuery(): ?string
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
     * Get msgIds
     *
     * @return IdsAttr
     */
    public function getMsgIds(): ?IdsAttr
    {
        return $this->msgIds;
    }

    /**
     * Set msgIds
     *
     * @param  IdsAttr $msgIds
     * @return self
     */
    public function setMsgIds(IdsAttr $msgIds): self
    {
        $this->msgIds = $msgIds;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ApplyFilterRulesEnvelope(new ApplyFilterRulesBody($this));
    }
}
