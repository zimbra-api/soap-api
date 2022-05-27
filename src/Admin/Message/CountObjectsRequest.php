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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Admin\Struct\{DomainSelector, UcServiceSelector};
use Zimbra\Common\Enum\CountObjectsType;
use Zimbra\Soap\Request;

/**
 * CountObjectsRequest class
 * Count number of objects.
 * 
 * Returns number of objects of requested type.
 * 
 * Note: For account/alias/dl, if a domain is specified, only entries on the specified domain are counted.
 * If no domain is specified, entries on all domains are counted.
 * 
 * For accountOnUCService/cosOnUCService/domainOnUCService, UCService is required, and domain cannot be specified.
 * 
 * For domain, if onlyRelated attribute is true and the request is sent by a delegate or
 * domain admin, counts only domain on which has rights, without requiring countDomain right.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CountObjectsRequest extends Request
{
    /**
     * Object type
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\CountObjectsType")
     * @XmlAttribute
     */
    private CountObjectsType $type;

    /**
     * Domain
     * 
     * @Accessor(getter="getDomains", setter="setDomains")
     * @SerializedName("domain")
     * @Type("array<Zimbra\Admin\Struct\DomainSelector>")
     * @XmlList(inline = true, entry = "domain")
     */
    private $domains = [];

    /**
     * UCService
     * @Accessor(getter="getUcService", setter="setUcService")
     * @SerializedName("ucservice")
     * @Type("Zimbra\Admin\Struct\UcServiceSelector")
     * @XmlElement
     */
    private ?UcServiceSelector $ucService = NULL;

    /**
     * Get only related if delegated/domain admin
     * @Accessor(getter="getOnlyRelated", setter="setOnlyRelated")
     * @SerializedName("onlyrelated")
     * @Type("bool")
     * @XmlAttribute
     */
    private $onlyRelated;

    /**
     * Constructor method for CountObjectsRequest
     * 
     * @param  CountObjectsType $type
     * @param  array $domains
     * @param  UcServiceSelector $ucService
     * @param  bool $onlyRelated
     * @return self
     */
    public function __construct(
        CountObjectsType $type,
        array $domains = [],
        ?UcServiceSelector $ucService = NULL,
        ?bool $onlyRelated = NULL
    )
    {
        $this->setType($type)
             ->setDomains($domains);
        if ($ucService instanceof UcServiceSelector) {
            $this->setUcService($ucService);
        }
        if (NULL !== $onlyRelated) {
            $this->setOnlyRelated($onlyRelated);
        }
    }

    /**
     * Gets object type
     *
     * @return CountObjectsType
     */
    public function getType(): CountObjectsType
    {
        return $this->type;
    }

    /**
     * Sets object type
     *
     * @param  CountObjectsType $type
     * @return self
     */
    public function setType(CountObjectsType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets only related
     *
     * @return bool
     */
    public function getOnlyRelated(): ?bool
    {
        return $this->onlyRelated;
    }

    /**
     * Sets only related
     *
     * @param  bool $onlyRelated
     * @return self
     */
    public function setOnlyRelated(bool $onlyRelated): self
    {
        $this->onlyRelated = $onlyRelated;
        return $this;
    }

    /**
     * Add a domain
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function addDomain(DomainSelector $domain): self
    {
        $this->domains[] = $domain;
        return $this;
    }

    /**
     * Sets domains
     *
     * @param  array $domains
     * @return self
     */
    public function setDomains(array $domains): self
    {
        $this->domains = [];
        foreach ($domains as $domain) {
            if ($domain instanceof DomainSelector) {
                $this->domains[] = $domain;
            }
        }
        return $this;
    }

    /**
     * Gets domains
     *
     * @return array
     */
    public function getDomains(): array
    {
        return $this->domains;
    }

    /**
     * Gets the ucservice.
     *
     * @return UcServiceSelector
     */
    public function getUcService(): ?UcServiceSelector
    {
        return $this->ucService;
    }

    /**
     * Sets the ucservice.
     *
     * @param  UcServiceSelector $ucService
     * @return self
     */
    public function setUcService(UcServiceSelector $ucService): self
    {
        $this->ucService = $ucService;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof CountObjectsEnvelope)) {
            $this->envelope = new CountObjectsEnvelope(
                new CountObjectsBody($this)
            );
        }
    }
}
