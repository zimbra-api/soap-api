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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Common\Struct\{AccountSelector, SoapEnvelopeInterface, SoapRequest};

/**
 * RemoveAccountLoggerRequest request class
 * Removes one or more custom loggers.
 * If both the account and logger are specified, removes the given account logger if it exists.
 * If only the account is specified or the category is "all", removes all custom loggers from that account.
 * If only the logger is specified, removes that custom logger from all accounts.
 * If neither element is specified, removes all custom loggers from all accounts on the server that receives the request.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RemoveAccountLoggerRequest extends SoapRequest
{
    /**
     * Logger category
     *
     * @Accessor(getter="getLogger", setter="setLogger")
     * @SerializedName("logger")
     * @Type("Zimbra\Admin\Struct\LoggerInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var LoggerInfo
     */
    #[Accessor(getter: "getLogger", setter: "setLogger")]
    #[SerializedName("logger")]
    #[Type(LoggerInfo::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?LoggerInfo $logger;

    /**
     * Use to select account
     *
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     *
     * @var AccountSelector
     */
    #[Accessor(getter: "getAccount", setter: "setAccount")]
    #[SerializedName("account")]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: "urn:zimbraAdmin")]
    private ?AccountSelector $account;

    /**
     * id
     *
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraAdmin")]
    private $id;

    /**
     * Constructor
     *
     * @param  LoggerInfo $logger
     * @param  AccountSelector $account
     * @param  string $id
     * @return self
     */
    public function __construct(
        ?LoggerInfo $logger = null,
        ?AccountSelector $account = null,
        ?string $id = null
    ) {
        $this->logger = $logger;
        $this->account = $account;
        if (null !== $id) {
            $this->setId($id);
        }
    }

    /**
     * Get the logger.
     *
     * @return LoggerInfo
     */
    public function getLogger(): ?LoggerInfo
    {
        return $this->logger;
    }

    /**
     * Set the logger.
     *
     * @param  LoggerInfo $logger
     * @return self
     */
    public function setLogger(LoggerInfo $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * Set the account.
     *
     * @return AccountSelector
     */
    public function getAccount(): ?AccountSelector
    {
        return $this->account;
    }

    /**
     * Set the account.
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new RemoveAccountLoggerEnvelope(
            new RemoveAccountLoggerBody($this)
        );
    }
}
