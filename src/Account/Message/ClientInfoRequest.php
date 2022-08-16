<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ClientInfoRequest class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ClientInfoRequest extends SoapRequest
{
    /**
     * Domain
     * 
     * @var DomainSelector
     */
    #[Accessor(getter: 'getDomain', setter: 'setDomain')]
    #[SerializedName(name: 'domain')]
    #[Type(name: DomainSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAccount')]
    private $domain;

    /**
     * Constructor
     *
     * @param  DomainSelector $domain
     * @return self
     */
    public function __construct(DomainSelector $domain)
    {
        $this->setDomain($domain);
    }

    /**
     * Set domain
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
     * Get domain
     *
     * @return DomainSelector
     */
    public function getDomain(): DomainSelector
    {
        return $this->domain;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ClientInfoEnvelope(
            new ClientInfoBody($this)
        );
    }
}
