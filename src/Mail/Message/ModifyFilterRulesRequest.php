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
use Zimbra\Mail\Struct\FilterRule;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyFilterRulesRequest class
 * Modify filter rules
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyFilterRulesRequest extends SoapRequest
{
    /**
     * Filter rules
     *
     * @var array
     */
    #[Accessor(getter: "getFilterRules", setter: "setFilterRules")]
    #[SerializedName("filterRules")]
    #[Type("array<Zimbra\Mail\Struct\FilterRule>")]
    #[XmlElement(namespace: "urn:zimbraMail")]
    #[XmlList(inline: false, entry: "filterRule", namespace: "urn:zimbraMail")]
    private array $filterRules = [];

    /**
     * Constructor
     *
     * @param  array $filterRules
     * @return self
     */
    public function __construct(array $filterRules = [])
    {
        $this->setFilterRules($filterRules);
    }

    /**
     * Add filterRule
     *
     * @param  FilterRule $filterRule
     * @return self
     */
    public function addFilterRule(FilterRule $filterRule): self
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
            static fn($rule) => $rule instanceof FilterRule
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyFilterRulesEnvelope(new ModifyFilterRulesBody($this));
    }
}
