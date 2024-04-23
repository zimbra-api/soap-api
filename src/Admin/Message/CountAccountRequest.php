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
 * CountAccountRequest class
 * Count number of accounts by cos in a domain
 * Note, it doesn't include any account with zimbraIsSystemResource=true, nor does it include any calendar resources.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CountAccountRequest extends SoapRequest
{
    /**
     * Domain
     * 
     * @var DomainSelector
     */
    #[Accessor(getter: 'getDomain', setter: 'setDomain')]
    #[SerializedName('domain')]
    #[Type(DomainSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private DomainSelector $domain;

    /**
     * Constructor
     * 
     * @param DomainSelector $domain
     * @return self
     */
    public function __construct(DomainSelector $domain)
    {
        $this->setDomain($domain);
    }

    /**
     * Get the domain.
     *
     * @return DomainSelector
     */
    public function getDomain(): DomainSelector
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
        return new CountAccountEnvelope(
            new CountAccountBody($this)
        );
    }
}
