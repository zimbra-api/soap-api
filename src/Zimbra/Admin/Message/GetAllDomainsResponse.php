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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllDomainsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllDomainsResponse")
 */
class GetAllDomainsResponse implements ResponseInterface
{
    /**
     * Information on domains
     * 
     * @Accessor(getter="getDomainList", setter="setDomainList")
     * @SerializedName("domain")
     * @Type("array<Zimbra\Admin\Struct\DomainInfo>")
     * @XmlList(inline = true, entry = "domain")
     */
    private $domainList;

    /**
     * Constructor method for GetAllDomainsResponse
     * @param array $domainList
     * @return self
     */
    public function __construct(array $domainList = [])
    {
        $this->setDomainList($domainList);
    }

    /**
     * Add a domain information
     *
     * @param  DomainInfo $domain
     * @return self
     */
    public function addDomain(DomainInfo $domain): self
    {
        $this->domainList[] = $domain;
        return $this;
    }

    /**
     * Sets domain informations
     *
     * @param  array $domainList
     * @return self
     */
    public function setDomainList(array $domainList): self
    {
        $this->domainList = [];
        foreach ($domainList as $domain) {
            if ($domain instanceof DomainInfo) {
                $this->domainList[] = $domain;
            }
        }
        return $this;
    }

    /**
     * Gets domain informations
     *
     * @return array
     */
    public function getDomainList(): array
    {
        return $this->domainList;
    }
}
