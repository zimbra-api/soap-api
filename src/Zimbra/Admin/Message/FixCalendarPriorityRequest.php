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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Soap\Request;
use Zimbra\Struct\NamedElement;

/**
 * FixCalendarPriorityRequest class
 * Deploy Zimlet(s)
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="FixCalendarPriorityRequest")
 */
class FixCalendarPriorityRequest extends Request
{
    /**
     * Sync flag
     * 1 (true) command blocks until processing finishes
     * 0 (false) [default]  command returns right away 
     * @Accessor(getter="getSync", setter="setSync")
     * @SerializedName("sync")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sync;

    /**
     * Accounts
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("account")
     * @Type("array<Zimbra\Struct\NamedElement>")
     * @XmlList(inline = true, entry = "account")
     */
    private $accounts;

    /**
     * Constructor method for FixCalendarPriorityRequest
     * @param  bool $sync
     * @param  arrat $accounts
     * @return self
     */
    public function __construct($sync = NULL, array $accounts = [])
    {
        $this->setAccounts($accounts);
        if (NULL !== $sync) {
            $this->setSync($sync);
        }
    }

    /**
     * Gets includeAccounts
     *
     * @return bool
     */
    public function getSync(): ?bool
    {
        return $this->includeAccounts;
    }

    /**
     * Sets includeAccounts
     *
     * @param  bool $includeAccounts
     * @return self
     */
    public function setSync($includeAccounts): self
    {
        $this->includeAccounts = (bool) $includeAccounts;
        return $this;
    }

    /**
     * Gets accounts
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * Sets accounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = [];
        foreach ($accounts as $account) {
            if ($account instanceof NamedElement) {
                $this->accounts[] = $account;
            }
        }
        return $this;
    }

    /**
     * Add an account
     *
     * @param  NamedElement $account
     * @return self
     */
    public function addAccount(NamedElement $account): self
    {
        $this->accounts[] = $account;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof FixCalendarPriorityEnvelope)) {
            $this->envelope = new FixCalendarPriorityEnvelope(
                new FixCalendarPriorityBody($this)
            );
        }
    }
}
