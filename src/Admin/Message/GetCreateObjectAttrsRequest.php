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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\{CosSelector, DomainSelector, TargetWithType};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetCreateObjectAttrsRequest request class
 * Returns attributes, with defaults and constraints if any,  that can be set by the admin when an object is created.
 * GetCreateObjectAttrsRequest returns the equivalent of setAttrs portion of GetEffectiveRightsResponse.
 * GetCreateObjectAttrsRequest is needed becasue GetEffectiveRightsRequest requires a target, but when we are creating a object, the target object does not exist yet. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetCreateObjectAttrsRequest extends SoapRequest
{
    /**
     * Target
     * 
     * @var TargetWithType
     */
    #[Accessor(getter: 'getTarget', setter: 'setTarget')]
    #[SerializedName('target')]
    #[Type(TargetWithType::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private TargetWithType $target;

    /**
     * Domain
     * required if {target-type} is account/calresource/dl/domain, ignored otherwise.
     * if {target-type} is account/calresource/dl: this is the domain in which the object will be in.
     * the domain can be speciffied by id or by nam
     * if {target-type} is domain, it is the domain name to be created.
     * 
     * @var DomainSelector
     */
    #[Accessor(getter: 'getDomain', setter: 'setDomain')]
    #[SerializedName('domain')]
    #[Type(DomainSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?DomainSelector $domain;

    /**
     * COS
     * Optional if {target-type} is account/calresource, ignored otherwise
     * If missing, default cos of the domain will be used
     * 
     * @var CosSelector
     */
    #[Accessor(getter: 'getCos', setter: 'setCos')]
    #[SerializedName('cos')]
    #[Type(CosSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?CosSelector $cos;

    /**
     * Constructor
     * 
     * @param  TargetWithType $target
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @return self
     */
    public function __construct(
        TargetWithType $target, ?DomainSelector $domain = null, ?CosSelector $cos = null
    )
    {
        $this->setTarget($target);
        $this->domain = $domain;
        $this->cos = $cos;
    }

    /**
     * Get the target.
     *
     * @return TargetWithType
     */
    public function getTarget(): ?TargetWithType
    {
        return $this->target;
    }

    /**
     * Set the target.
     *
     * @param  TargetWithType $target
     * @return self
     */
    public function setTarget(TargetWithType $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Set the domain.
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
     * Set the cos.
     *
     * @return CosSelector
     */
    public function getCos(): ?CosSelector
    {
        return $this->cos;
    }

    /**
     * Set the cos.
     *
     * @param  CosSelector $cos
     * @return self
     */
    public function setCos(CosSelector $cos): self
    {
        $this->cos = $cos;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetCreateObjectAttrsEnvelope(
            new GetCreateObjectAttrsBody($this)
        );
    }
}
