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
use Zimbra\Admin\Struct\CosSelector as Cos;
use Zimbra\Admin\Struct\DomainSelector as Domain;
use Zimbra\Admin\Struct\TargetWithType as Target;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetCreateObjectAttrsRequest extends Request
{
    /**
     * Target
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\TargetWithType")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private Target $target;

    /**
     * Domain
     * required if {target-type} is account/calresource/dl/domain, ignored otherwise.
     * if {target-type} is account/calresource/dl: this is the domain in which the object will be in.
     * the domain can be speciffied by id or by nam
     * if {target-type} is domain, it is the domain name to be created.
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Domain $domain = NULL;

    /**
     * COS
     * Optional if {target-type} is account/calresource, ignored otherwise
     * If missing, default cos of the domain will be used
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Admin\Struct\CosSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Cos $cos = NULL;

    /**
     * Constructor method for GetCreateObjectAttrsRequest
     * 
     * @param  Target $target
     * @param  Domain $domain
     * @param  Cos $cos
     * @return self
     */
    public function __construct(Target $target, ?Domain $domain = NULL, ?Cos $cos = NULL)
    {
        $this->setTarget($target);
        if ($domain instanceof Domain) {
            $this->setDomain($domain);
        }
        if ($cos instanceof Cos) {
            $this->setCos($cos);
        }
    }

    /**
     * Gets the target.
     *
     * @return Target
     */
    public function getTarget(): ?Target
    {
        return $this->target;
    }

    /**
     * Sets the target.
     *
     * @param  Target $target
     * @return self
     */
    public function setTarget(Target $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Sets the domain.
     *
     * @return Domain
     */
    public function getDomain(): ?Domain
    {
        return $this->domain;
    }

    /**
     * Sets the domain.
     *
     * @param  Domain $domain
     * @return self
     */
    public function setDomain(Domain $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * Sets the cos.
     *
     * @return Cos
     */
    public function getCos(): ?Cos
    {
        return $this->cos;
    }

    /**
     * Sets the cos.
     *
     * @param  Cos $cos
     * @return self
     */
    public function setCos(Cos $cos): self
    {
        $this->cos = $cos;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetCreateObjectAttrsEnvelope(
            new GetCreateObjectAttrsBody($this)
        );
    }
}
