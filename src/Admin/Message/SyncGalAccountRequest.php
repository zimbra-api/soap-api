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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\SyncGalAccountSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * SyncGalAccount request class
 * Sync GalAccount
 * If fullSync is set to false (or unset) the default behavior is trickle sync which will pull in any new contacts or modified contacts since last sync. 
 * If fullSync is set to true, then the server will go through all the contacts that appear in GAL, and resolve deleted contacts in addition to new or modified ones.
 * If reset attribute is set, then all the contacts will be populated again, regardless of the status since last sync.
 * Reset needs to be done when there is a significant change in the configuration, such as filter, attribute map, or search base.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SyncGalAccountRequest extends SoapRequest
{
    /**
     * Sync GalAccount specification
     * 
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @Type("array<Zimbra\Admin\Struct\SyncGalAccountSpec>")
     * @XmlList(inline=true, entry="account", namespace="urn:zimbraAdmin")
     * 
     * @var array
     */
    #[Accessor(getter: 'getAccounts', setter: 'setAccounts')]
    #[Type('array<Zimbra\Admin\Struct\SyncGalAccountSpec>')]
    #[XmlList(inline: true, entry: 'account', namespace: 'urn:zimbraAdmin')]
    private $accounts = [];

    /**
     * Constructor
     * 
     * @param array $accounts
     * @return self
     */
    public function __construct(array $accounts = [])
    {
        $this->setAccounts($accounts);
    }

    /**
     * Add account
     *
     * @param  SyncGalAccountSpec $account
     * @return self
     */
    public function addAccount(SyncGalAccountSpec $account): self
    {
        $this->accounts[] = $account;
        return $this;
    }

    /**
     * Set accounts
     *
     * @param array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = array_filter($accounts, static fn ($account) => $account instanceof SyncGalAccountSpec);
        return $this;
    }

    /**
     * Get accounts
     *
     * @return array
     */
    public function getAccounts(): ?array
    {
        return $this->accounts;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new SyncGalAccountEnvelope(
            new SyncGalAccountBody($this)
        );
    }
}
