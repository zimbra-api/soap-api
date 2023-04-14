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
use Zimbra\Common\Struct\{NamedElement, SoapEnvelopeInterface, SoapRequest};

/**
 * FixCalendarPriorityRequest class
 * Fix Calendar priority 
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FixCalendarPriorityRequest extends SoapRequest
{
    /**
     * Sync flag
     * 1 (true) command blocks until processing finishes
     * 0 (false) [default]  command returns right away 
     * 
     * @var bool
     */
    #[Accessor(getter: 'getSync', setter: 'setSync')]
    #[SerializedName('sync')]
    #[Type('bool')]
    #[XmlAttribute]
    private $sync;

    /**
     * Accounts
     * 
     * @var array
     */
    #[Accessor(getter: 'getAccounts', setter: 'setAccounts')]
    #[Type('array<Zimbra\Common\Struct\NamedElement>')]
    #[XmlList(inline: true, entry: 'account', namespace: 'urn:zimbraAdmin')]
    private $accounts = [];

    /**
     * Constructor
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
        $this->accounts = array_filter(
            $accounts, static fn ($account) => $account instanceof NamedElement
        );
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new FixCalendarPriorityEnvelope(
            new FixCalendarPriorityBody($this)
        );
    }
}
