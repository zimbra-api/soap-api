<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copydomain and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Common\Struct\NamedElement;

/**
 * InDomainInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InDomainInfo
{
    /**
     * Domains
     * 
     * @Accessor(getter="getDomains", setter="setDomains")
     * @Type("array<Zimbra\Common\Struct\NamedElement>")
     * @XmlList(inline=true, entry="domain", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getDomains', setter: 'setDomains')]
    #[Type('array<Zimbra\Common\Struct\NamedElement>')]
    #[XmlList(inline: true, entry: 'domain', namespace: 'urn:zimbraAdmin')]
    private $domains = [];

    /**
     * Rights
     * 
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("rights")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var EffectiveRightsInfo
     */
    #[Accessor(getter: 'getRights', setter: 'setRights')]
    #[SerializedName('rights')]
    #[Type(EffectiveRightsInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $rights;

    /**
     * Constructor
     * 
     * @param EffectiveRightsInfo $rights
     * @param array $domains
     * @return self
     */
    public function __construct(EffectiveRightsInfo $rights, array $domains = [])
    {
        $this->setRights($rights)
             ->setDomains($domains);
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
     * Set domains
     *
     * @param  array $domains
     * @return self
     */
    public function setDomains(array $domains): self
    {
        $this->domains = array_filter($domains, static fn ($domain) => $domain instanceof NamedElement);
        return $this;
    }

    /**
     * Adds a domain
     *
     * @param  NamedElement $domain
     * @return self
     */
    public function addDomain(NamedElement $domain): self
    {
        $this->domains[] = $domain;
        return $this;
    }

    /**
     * Get rights
     *
     * @return EffectiveRightsInfo
     */
    public function getRights(): EffectiveRightsInfo
    {
        return $this->rights;
    }

    /**
     * Set rights
     *
     * @param  EffectiveRightsInfo $rights
     * @return self
     */
    public function setRights(EffectiveRightsInfo $rights): self
    {
        $this->rights = $rights;
        return $this;
    }
}
