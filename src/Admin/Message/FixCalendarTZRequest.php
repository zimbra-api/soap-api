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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Admin\Struct\TzFixup;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * FixCalendarTZRequest class
 * Fix timezone definitions in appointments and tasks to reflect changes in daylight savings time rules in various timezones.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FixCalendarTZRequest extends SoapRequest
{
    /**
     * Sync flag
     * 1 (true) command blocks until processing finishes
     * 0 (false) [default]  command returns right away 
     * 
     * @Accessor(getter="getSync", setter="setSync")
     * @SerializedName("sync")
     * @Type("bool")
     * @XmlAttribute
     */
    private $sync;

    /**
     * Fix appts/tasks that have instances after this time
     * default = January 1, 2008 00:00:00 in GMT+13:00 timezone.
     * 
     * @Accessor(getter="getAfter", setter="setAfter")
     * @SerializedName("after")
     * @Type("integer")
     * @XmlAttribute
     */
    private $after;

    /**
     * Accounts
     * 
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @Type("array<Zimbra\Common\Struct\NamedElement>")
     * @XmlList(inline=true, entry="account", namespace="urn:zimbraAdmin")
     */
    private $accounts = [];

    /**
     * Fixup rules wrapper
     * 
     * @Accessor(getter="getTzFixup", setter="setTzFixup")
     * @SerializedName("tzfixup")
     * @Type("Zimbra\Admin\Struct\TzFixup")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @var TzFixup
     */
    private $tzFixup;

    /**
     * Constructor
     * 
     * @param  bool $sync
     * @param  int $after
     * @param  array $accounts
     * @param  TzFixup $tzFixup
     * @return self
     */
    public function __construct(
        ?bool $sync = NULL, ?int $after = NULL, array $accounts = [], ?TzFixup $tzFixup = NULL
    )
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
     * Get sync
     *
     * @return bool
     */
    public function getSync(): ?bool
    {
        return $this->sync;
    }

    /**
     * Set sync
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
     * Get after
     *
     * @return int
     */
    public function getAfter(): ?int
    {
        return $this->after;
    }

    /**
     * Set after
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
     * Get accounts
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * Set accounts
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
     * Get the tzFixup.
     *
     * @return TzFixup
     */
    public function getTzFixup(): ?TzFixup
    {
        return $this->tzFixup;
    }

    /**
     * Set the tzFixup.
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new FixCalendarTZEnvelope(
            new FixCalendarTZBody($this)
        );
    }
}
