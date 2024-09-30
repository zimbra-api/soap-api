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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest, WaitSetAddSpec};

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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AdminCreateWaitSetRequest extends SoapRequest
{
    /**
     * Default interest types: comma-separated list
     *
     * @Accessor(getter="getDefaultInterests", setter="setDefaultInterests")
     * @SerializedName("defTypes")
     * @Type("string")
     * @XmlAttribute
     *
     * @var string
     */
    #[Accessor(getter: "getDefaultInterests", setter: "setDefaultInterests")]
    #[SerializedName("defTypes")]
    #[Type("string")]
    #[XmlAttribute]
    private $defaultInterests;

    /**
     * All accounts
     *
     * @Accessor(getter="getAllAccounts", setter="setAllAccounts")
     * @SerializedName("allAccounts")
     * @Type("bool")
     * @XmlAttribute
     *
     * @var bool
     */
    #[Accessor(getter: "getAllAccounts", setter: "setAllAccounts")]
    #[SerializedName("allAccounts")]
    #[Type("bool")]
    #[XmlAttribute]
    private $allAccounts;

    /**
     * Waitsets to add
     *
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("add")
     * @Type("array<Zimbra\Common\Struct\WaitSetAddSpec>")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * @XmlList(inline=false, entry="a", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getAccounts", setter: "setAccounts")]
    #[SerializedName("add")]
    #[Type("array<Zimbra\Common\Struct\WaitSetAddSpec>")]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    #[XmlList(inline: false, entry: "a", namespace: "urn:zimbraAdmin")]
    private $accounts = [];

    /**
     * Constructor
     *
     * @param string $defaultInterests
     * @param bool $allAccounts
     * @param array $accounts
     * @return self
     */
    public function __construct(
        string $defaultInterests = "",
        ?bool $allAccounts = null,
        array $accounts = []
    ) {
        $this->setDefaultInterests($defaultInterests)->setAccounts($accounts);
        if (null !== $allAccounts) {
            $this->setAllAccounts($allAccounts);
        }
    }

    /**
     * Get defaultInterests
     *
     * @return string
     */
    public function getDefaultInterests(): string
    {
        return $this->defaultInterests;
    }

    /**
     * Set defaultInterests
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
     * Get all accounts
     *
     * @return bool
     */
    public function getAllAccounts(): ?bool
    {
        return $this->allAccounts;
    }

    /**
     * Set all accounts
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
     * Set WaitSet sequence
     *
     * @param array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = array_filter(
            $accounts,
            static fn($account) => $account instanceof WaitSetAddSpec
        );
        return $this;
    }

    /**
     * Get WaitSet sequence
     *
     * @return array
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new AdminCreateWaitSetEnvelope(
            new AdminCreateWaitSetBody($this)
        );
    }
}
