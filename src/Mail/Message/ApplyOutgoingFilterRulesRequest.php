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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * ApplyOutgoingFilterRulesRequest class
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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ApplyOutgoingFilterRulesRequest extends Request
{
    /**
     * Filter rules
     * 
     * @Accessor(getter="getFilterRules", setter="setFilterRules")
     * @SerializedName("filterRules")
     * @Type("array<Zimbra\Common\Struct\NamedElement>")
     * @XmlList(inline=false, entry="filterRule")
     */
    private $filterRules = [];

    /**
     * Comma-separated list of message IDs
     * @Accessor(getter="getMsgIds", setter="setMsgIds")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\IdsAttr")
     * @XmlElement
     */
    private ?IdsAttr $msgIds = NULL;

    /**
     * Query string
     * @Accessor(getter="getQuery", setter="setQuery")
     * @SerializedName("query")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $query;

    /**
     * Constructor method for ApplyOutgoingFilterRulesRequest
     *
     * @param  array $filterRules
     * @param  IdsAttr $msgIds
     * @param  string $query
     * @return self
     */
    public function __construct(
        array $filterRules = [],
        ?IdsAttr $msgIds = NULL,
        ?string $query = NULL
    )
    {
        $this->setFilterRules($filterRules);
        if ($msgIds instanceof IdsAttr) {
            $this->setMsgIds($msgIds);
        }
        if (NULL !== $query) {
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
     * Sets filterRules
     *
     * @param  array $rules
     * @return self
     */
    public function setFilterRules(array $rules): self
    {
        $this->filterRules = array_filter($rules, static fn ($rule) => $rule instanceof NamedElement);
        return $this;
    }

    /**
     * Gets filterRules
     *
     * @return array
     */
    public function getFilterRules(): array
    {
        return $this->filterRules;
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
    public function setQuery(string $query): self
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Gets msgIds
     *
     * @return IdsAttr
     */
    public function getMsgIds(): ?IdsAttr
    {
        return $this->msgIds;
    }

    /**
     * Sets msgIds
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new ApplyOutgoingFilterRulesEnvelope(
            new ApplyOutgoingFilterRulesBody($this)
        );
    }
}
