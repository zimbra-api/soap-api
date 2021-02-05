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
use Zimbra\Admin\Struct\SyncGalAccountSpec;
use Zimbra\Soap\Request;

/**
 * SyncGalAccount request class
 * Sync GalAccount
 * If fullSync is set to false (or unset) the default behavior is trickle sync which will pull in any new contacts or modified contacts since last sync. 
 * If fullSync is set to true, then the server will go through all the contacts that appear in GAL, and resolve deleted contacts in addition to new or modified ones.
 * If reset attribute is set, then all the contacts will be populated again, regardless of the status since last sync. Reset needs to be done when there is a significant change in the configuration, such as filter, attribute map, or search base.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="SyncGalAccountRequest")
 */
class SyncGalAccountRequest extends Request
{
    /**
     * Sync GalAccount specification
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("account")
     * @Type("array<Zimbra\Admin\Struct\SyncGalAccountSpec>")
     * @XmlList(inline = true, entry = "account")
     */
    private $accounts;

    /**
     * Constructor method for SyncGalAccountRequest
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
     * Sets accounts
     *
     * @param array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = [];
        foreach ($accounts as $account) {
            if ($account instanceof SyncGalAccountSpec) {
                $this->accounts[] = $account;
            }
        }
        return $this;
    }

    /**
     * Gets accounts
     *
     * @return array
     */
    public function getAccounts(): ?array
    {
        return $this->accounts;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof SyncGalAccountEnvelope)) {
            $this->envelope = new SyncGalAccountEnvelope(
                new SyncGalAccountBody($this)
            );
        }
    }
}