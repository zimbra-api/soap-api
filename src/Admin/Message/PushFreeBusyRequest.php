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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlList};
use Zimbra\Admin\Struct\Names;
use Zimbra\Common\Struct\Id;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * PushFreeBusyRequest class
 * Push Free/Busy.
 * The request must include either <domain/> or <account/>.
 * When <domain/> is specified in the request, the server will push the free/busy for all the accounts in the domain to the configured free/busy providers.
 * When <account/> list is specified, the server will push the free/busy for the listed accounts to the providers. 
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class PushFreeBusyRequest extends SoapRequest
{
    /**
     * Domain names specification
     * @Accessor(getter="getDomains", setter="setDomains")
     * @SerializedName("domain")
     * @Type("Zimbra\Admin\Struct\Names")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Names $domains = NULL;

    /**
     * Account ID
     * 
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @Type("array<Zimbra\Common\Struct\Id>")
     * @XmlList(inline=true, entry="account", namespace="urn:zimbraAdmin")
     */
    private $accounts = [];

    /**
     * Constructor method for PushFreeBusyRequest
     *
     * @param  Names $domains
     * @param  array $accounts
     * @return self
     */
    public function __construct(?Names $domains = NULL, array $accounts = [])
    {
        $this->setAccounts($accounts);
        if ($domains instanceof Names) {
            $this->setDomains($domains);
        }
    }

    /**
     * Get zimbra domains
     *
     * @return Names
     */
    public function getDomains(): ?Names
    {
        return $this->domains;
    }

    /**
     * Set zimbra domains
     *
     * @param  Names $domains
     * @return self
     */
    public function setDomains(Names $domains): self
    {
        $this->domains = $domains;
        return $this;
    }

    /**
     * Add accounts
     *
     * @param  Id $account
     * @return self
     */
    public function addAccount(Id $account): self
    {
        $this->accounts[] = $account;
        return $this;
    }

    /**
     * Set accounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = array_filter($accounts, static fn ($account) => $account instanceof Id);
        return $this;
    }

    /**
     * Get accounts
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new PushFreeBusyEnvelope(
            new PushFreeBusyBody($this)
        );
    }
}
