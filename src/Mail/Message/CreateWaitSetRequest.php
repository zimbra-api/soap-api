<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Common\Enum\InterestType;
use Zimbra\Common\Struct\{CreateWaitSetReq, SoapEnvelopeInterface, SoapRequest, WaitSetAddSpec};

/**
 * CreateWaitSetRequest class
 * Create a waitset to listen for changes on one or more accounts
 * Called once to initialize a WaitSet and to set its "default interest types"
 * WaitSet: scalable mechanism for listening for changes to one or more accounts
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateWaitSetRequest extends SoapRequest implements CreateWaitSetReq
{
    /**
     * Default interest types: comma-separated list.  Currently:
     * f: folders
     * m: messages
     * c: contacts
     * a: appointments
     * t: tasks
     * d: documents
     * all: all types (equiv to "f,m,c,a,t,d")
     * 
     * This is used if types isn't specified for an account
     * @Accessor(getter="getDefaultInterests", setter="setDefaultInterests")
     * @SerializedName("defTypes")
     * @Type("string")
     * @XmlAttribute
     * 
     * @var string
     */
    #[Accessor(getter: 'getDefaultInterests', setter: 'setDefaultInterests')]
    #[SerializedName('defTypes')]
    #[Type('string')]
    #[XmlAttribute]
    private $defaultInterests;

    /**
     * If {all-accounts} is set, then all mailboxes on the system will be listened
     * to, including any mailboxes which are created on the system while the WaitSet is in existence.
     * Additionally:
     * - <add>, <remove> and <update> tags are IGNORED
     * - The requesting authtoken must be an admin token
     * AllAccounts WaitSets are *semi-persistent*, that is, even if the server restarts, it is OK to call
     * <WaitSetRequest> passing in your previous sequence number.  The server will attempt to resynchronize the
     * waitset using the sequence number you provide (the server's ability to do this is limited by the RedoLogs that
     * are available)
     * 
     * @Accessor(getter="getAllAccounts", setter="setAllAccounts")
     * @SerializedName("allAccounts")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getAllAccounts', setter: 'setAllAccounts')]
    #[SerializedName('allAccounts')]
    #[Type('bool')]
    #[XmlAttribute]
    private $allAccounts;

    /**
     * Waitsets to add
     * 
     * @Accessor(getter="getAccounts", setter="setAccounts")
     * @SerializedName("add")
     * @Type("array<Zimbra\Common\Struct\WaitSetAddSpec>")
     * @XmlElement(namespace="urn:zimbraMail")
     * @XmlList(inline=false, entry="a", namespace="urn:zimbraMail")
     * 
     * @var array
     */
    #[Accessor(getter: 'getAccounts', setter: 'setAccounts')]
    #[SerializedName('add')]
    #[Type('array<Zimbra\Common\Struct\WaitSetAddSpec>')]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    #[XmlList(inline: false, entry: 'a', namespace: 'urn:zimbraMail')]
    private $accounts = [];

    /**
     * Constructor
     *
     * @param  string $defaultInterests
     * @param  bool $allAccounts
     * @param  array $accounts
     * @return self
     */
    public function __construct(
        string $defaultInterests = '', ?bool $allAccounts = NULL, array $accounts = []
    )
    {
        $this->setDefaultInterests($defaultInterests)
             ->setAccounts($accounts);
        if (NULL !== $allAccounts) {
            $this->setAllAccounts($allAccounts);
        }
    }

    /**
     * Add account
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
     * Set accounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = array_filter($accounts, static fn ($account) => $account instanceof WaitSetAddSpec);
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
        $types = array_filter(explode(',', $defaultInterests), static fn ($type) => InterestType::isValid($type));
        $this->defaultInterests = implode(',', array_unique($types));
        return $this;
    }

    /**
     * Get allAccounts
     *
     * @return bool
     */
    public function getAllAccounts(): ?bool
    {
        return $this->allAccounts;
    }

    /**
     * Set allAccounts
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
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CreateWaitSetEnvelope(
            new CreateWaitSetBody($this)
        );
    }
}
