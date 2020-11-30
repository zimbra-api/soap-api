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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};
use Zimbra\Admin\Struct\TzFixup;
use Zimbra\Soap\Request;
use Zimbra\Struct\NamedElement;

/**
 * FixCalendarTZRequest class
 * Fix timezone definitions in appointments and tasks to reflect changes in daylight savings time rules in various timezones.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="FixCalendarTZRequest")
 */
class FixCalendarTZRequest extends Request
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
     * Fix appts/tasks that have instances after this time
     * default = January 1, 2008 00:00:00 in GMT+13:00 timezone.
     * @Accessor(getter="getAfter", setter="setAfter")
     * @SerializedName("after")
     * @Type("integer")
     * @XmlAttribute
     */
    private $after;

    /**
     * Accounts
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("account")
     * @Type("array<Zimbra\Struct\NamedElement>")
     * @XmlList(inline = true, entry = "account")
     */
    private $accounts;

    /**
     * Fixup rules wrapper
     * @Accessor(getter="getTzFixup", setter="setTzFixup")
     * @SerializedName("tzfixup")
     * @Type("Zimbra\Admin\Struct\TzFixup")
     * @XmlElement
     */
    private $tzFixup;

    /**
     * Constructor method for FixCalendarTZRequest
     * 
     * @param  bool $sync
     * @param  int $after
     * @param  array $accounts
     * @param  TzFixup $tzFixup
     * @return self
     */
    public function __construct(?bool $sync = NULL, ?int $after = NULL, array $accounts = [], ?TzFixup $tzFixup = NULL)
    {
        $this->setAccounts($accounts);
        if (NULL !== $sync) {
            $this->setSync($sync);
        }
        if (NULL !== $after) {
            $this->setAfter($after);
        }
        if ($tzFixup instanceof TzFixup) {
            $this->setTzFixup($tzFixup);
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
     * Gets after
     *
     * @return int
     */
    public function getAfter(): ?int
    {
        return $this->after;
    }

    /**
     * Sets after
     *
     * @param  int $after
     * @return self
     */
    public function setAfter(int $after): self
    {
        $this->after = $after;
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
     * Gets the tzFixup.
     *
     * @return TzFixup
     */
    public function getTzFixup(): ?TzFixup
    {
        return $this->tzFixup;
    }

    /**
     * Sets the tzFixup.
     *
     * @param  TzFixup $tzFixup
     * @return self
     */
    public function setTzFixup(TzFixup $tzFixup): self
    {
        $this->tzFixup = $tzFixup;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof FixCalendarTZEnvelope)) {
            $this->envelope = new FixCalendarTZEnvelope(
                new FixCalendarTZBody($this)
            );
        }
    }
}
