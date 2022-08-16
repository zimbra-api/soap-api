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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CountObjectsRequest extends SoapRequest
{
    /**
     * Object type
     * 
     * @var CountObjectsType
     */
    #[Accessor(getter: 'getType', setter: 'setType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\CountObjectsType>')]
    #[XmlAttribute]
    private $type;

    /**
     * Domain
     * 
     * @var array
     */
    #[Accessor(getter: 'getDomains', setter: 'setDomains')]
    #[Type(name: 'array<Zimbra\Admin\Struct\DomainSelector>')]
    #[XmlList(inline: true, entry: 'domain', namespace: 'urn:zimbraAdmin')]
    private $domains = [];

    /**
     * UCService
     * 
     * @var UcServiceSelector
     */
    #[Accessor(getter: 'getUcService', setter: 'setUcService')]
    #[SerializedName(name: 'ucservice')]
    #[Type(name: UcServiceSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $ucService;

    /**
     * Get only related if delegated/domain admin
     * 
     * @var bool
     */
    #[Accessor(getter: 'getOnlyRelated', setter: 'setOnlyRelated')]
    #[SerializedName(name: 'onlyrelated')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $onlyRelated;

    /**
     * Constructor
     * 
     * @param  CountObjectsType $type
     * @param  array $domains
     * @param  UcServiceSelector $ucService
     * @param  bool $onlyRelated
     * @return self
     */
    public function __construct(
        ?CountObjectsType $type = NULL,
        array $domains = [],
        ?UcServiceSelector $ucService = NULL,
        ?bool $onlyRelated = NULL
    )
    {
        $this->setType($type ?? new CountObjectsType('account'))
             ->setDomains($domains);
        if ($ucService instanceof UcServiceSelector) {
            $this->setUcService($ucService);
        }
        if (NULL !== $onlyRelated) {
            $this->setOnlyRelated($onlyRelated);
        }
    }

    /**
     * Get object type
     *
     * @return CountObjectsType
     */
    public function getType(): CountObjectsType
    {
        return $this->type;
    }

    /**
     * Set object type
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
     * Get only related
     *
     * @return bool
     */
    public function getOnlyRelated(): ?bool
    {
        return $this->onlyRelated;
    }

    /**
     * Set only related
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
     * Set domains
     *
     * @param  array $domains
     * @return self
     */
    public function setDomains(array $domains): self
    {
        $this->domains = array_filter($domains, static fn ($domain) => $domain instanceof DomainSelector);
        return $this;
    }

    /**
     * Get domains
     *
     * @return array
     */
    public function getDomains(): array
    {
        return $this->domains;
    }

    /**
     * Get the ucservice.
     *
     * @return UcServiceSelector
     */
    public function getUcService(): ?UcServiceSelector
    {
        return $this->ucService;
    }

    /**
     * Set the ucservice.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CountObjectsEnvelope(
            new CountObjectsBody($this)
        );
    }
}
