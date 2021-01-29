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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\DomainSelector as Domain;
use Zimbra\Soap\Request;

/**
 * GetAllDistributionListsRequest request class
 * Get all distribution lists that match the selection criteria
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllDistributionListsRequest")
 */
class GetAllDistributionListsRequest extends Request
{
    /**
     * Domain
     * @Accessor(getter="getDomain", setter="setDomain")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\DomainSelector")
     * @XmlElement
     */
    private $domain;

    /**
     * Constructor method for GetAllDistributionListsRequest
     * 
     * @param  Domain $domain
     * @return self
     */
    public function __construct(?Domain $domain = NULL)
    {
        if ($domain instanceof Domain) {
            $this->setDomain($domain);
        }
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAllDistributionListsEnvelope)) {
            $this->envelope = new GetAllDistributionListsEnvelope(
                new GetAllDistributionListsBody($this)
            );
        }
    }
}
