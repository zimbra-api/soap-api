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
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetAllDistributionListsRequest request class
 * Get all distribution lists that match the selection criteria
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllDistributionListsRequest extends SoapRequest
{
    /**
     * Domain
     * 
     * @var DomainSelector
     */
    #[Accessor(getter: 'getDomain', setter: 'setDomain')]
    #[SerializedName(name: 'domain')]
    #[Type(name: DomainSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $domain;

    /**
     * Constructor
     * 
     * @param  DomainSelector $domain
     * @return self
     */
    public function __construct(?DomainSelector $domain = NULL)
    {
        if ($domain instanceof DomainSelector) {
            $this->setDomain($domain);
        }
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetAllDistributionListsEnvelope(
            new GetAllDistributionListsBody($this)
        );
    }
}
