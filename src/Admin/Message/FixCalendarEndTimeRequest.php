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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * FixCalendarEndTimeRequest class
 * Fix Calendar End Times
 * Re-calculate the end times used for calendar items after changes to the recurrence expansion configuration.
 * The current configured values can be determined from: zmprov getAllConfig | grep zimbraCalendarRecurrence
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FixCalendarEndTimeRequest extends Request
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
     * @Type("array<Zimbra\Common\Struct\NamedElement>")
     * @XmlList(inline=true, entry="account", namespace="urn:zimbraAdmin")
     */
    private $accounts = [];

    /**
     * Constructor method for FixCalendarEndTimeRequest
     * 
     * @param  bool $sync
     * @param  array $accounts
     * @return self
     */
    public function __construct(?bool $sync = NULL, array $accounts = [])
    {
        $this->setAccounts($accounts);
        if (NULL !== $sync) {
            $this->setSync($sync);
        }
    }

    /**
     * Gets sync
     *
     * @return bool
     */
    public function getSync(): ?bool
    {
        return $this->sync;
    }

    /**
     * Sets sync
     *
     * @param  bool $sync
     * @return self
     */
    public function setSync(bool $sync): self
    {
        $this->sync = $sync;
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
        $this->accounts = array_filter($accounts, static fn ($account) => $account instanceof NamedElement);
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
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new FixCalendarEndTimeEnvelope(
            new FixCalendarEndTimeBody($this)
        );
    }
}
