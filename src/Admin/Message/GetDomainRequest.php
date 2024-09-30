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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Common\Struct\{
    AttributeSelector,
    AttributeSelectorTrait,
    SoapEnvelopeInterface,
    SoapRequest
};

/**
 * GetDomainRequest class
 * Get information about a domain
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDomainRequest extends SoapRequest implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * If {apply-config} is 1 (true), then certain unset attrs on a domain will get their values from the global config.
     * if {apply-config} is 0 (false), then only attributes directly set on the domain will be returned
     *
     * @var bool
     */
    #[Accessor(getter: "isApplyConfig", setter: "setApplyConfig")]
    #[SerializedName("applyConfig")]
    #[Type("bool")]
    #[XmlAttribute]
    private $applyConfig;

    /**
     * Domain
     *
     * @var DomainSelector
     */
    #[Accessor(getter: "getDomain", setter: "setDomain")]
    #[SerializedName("domain")]
    #[Type(DomainSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?DomainSelector $domain;

    /**
     * Constructor
     *
     * @param  DomainSelector $domain
     * @param  bool $applyConfig
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?DomainSelector $domain = null,
        ?bool $applyConfig = null,
        ?string $attrs = null
    ) {
        $this->domain = $domain;
        if (null !== $applyConfig) {
            $this->setApplyConfig($applyConfig);
        }
        if (null !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Get applyConfig
     *
     * @return bool
     */
    public function isApplyConfig(): ?bool
    {
        return $this->applyConfig;
    }

    /**
     * Set applyConfig
     *
     * @param  bool $applyConfig
     * @return self
     */
    public function setApplyConfig(bool $applyConfig): self
    {
        $this->applyConfig = $applyConfig;
        return $this;
    }

    /**
     * Get the domain.
     *
     * @return DomainSelector
     */
    public function getDomain(): ?DomainSelector
    {
        return $this->domain;
    }

    /**
     * Set the domain.
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function setDomain(DomainSelector $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetDomainEnvelope(new GetDomainBody($this));
    }
}
