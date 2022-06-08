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
use Zimbra\Common\Struct\WaitSetAddSpec;
use Zimbra\Soap\{EnvelopeInterface, Request};

/**
 * AdminCreateWaitSet request class
 * Create a waitset to listen for changes on one or more accounts
 * Called once to initialize a WaitSet and to set its "default interest types" 
 * WaitSet: scalable mechanism for listening for changes to one or more accounts
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AdminCreateWaitSetRequest extends Request
{
    /**
     * Default interest types: comma-separated list
     * @Accessor(getter="getDefaultInterests", setter="setDefaultInterests")
     * @SerializedName("defTypes")
     * @Type("string")
     * @XmlAttribute
     */
    private $defaultInterests;

    /**
     * All accounts
     * @Accessor(getter="getAllAccounts", setter="setAllAccounts")
     * @SerializedName("allAccounts")
     * @Type("bool")
     * @XmlAttribute
     */
    private $allAccounts;

    /**
     * Waitsets to add
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("add")
     * @Type("array<Zimbra\Common\Struct\WaitSetAddSpec>")
     * @XmlList(inline = false, entry = "a")
     */
    private $accounts = [];

    /**
     * Constructor method for AdminCreateWaitSetRequest
     * 
     * @param string $defaultInterests
     * @param bool $allAccounts
     * @param array $accounts
     * @return self
     */
    public function __construct(
        string $defaultInterests,
        ?bool $allAccounts = NULL,
        array $accounts = []
    )
    {
        $this->setDefaultInterests($defaultInterests)
             ->setAccounts($accounts);
        if (NULL !== $allAccounts) {
            $this->setAllAccounts($allAccounts);
        }
    }

    /**
     * Gets defaultInterests
     *
     * @return string
     */
    public function getDefaultInterests(): string
    {
        return $this->defaultInterests;
    }

    /**
     * Sets defaultInterests
     *
     * @param  string $defaultInterests
     * @return self
     */
    public function setDefaultInterests(string $defaultInterests): self
    {
        $this->defaultInterests = $defaultInterests;
        return $this;
    }

    /**
     * Gets all accounts
     *
     * @return bool
     */
    public function getAllAccounts(): ?bool
    {
        return $this->allAccounts;
    }

    /**
     * Sets all accounts
     *
     * @param  bool $allAccounts
     * @return self
     */
    public function setAllAccounts(bool $allAccounts): self
    {
        $this->allAccounts = $allAccounts;
        return $this;
    }

    /**
     * Add WaitSet
     *
     * @param  WaitSetAddSpec $account
     * @return self
     */
    public function addAccount(WaitSetAddSpec $account): self
    {
        $this->accounts[] = $account;
        return $this;
    }

    /**
     * Sets WaitSet sequence
     *
     * @param array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = array_filter($accounts, static fn($account) => $account instanceof WaitSetAddSpec);
        return $this;
    }

    /**
     * Gets WaitSet sequence
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
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new AdminCreateWaitSetEnvelope(
            new AdminCreateWaitSetBody($this)
        );
    }
}
