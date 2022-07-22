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
use Zimbra\Admin\Struct\LoggerInfo as Logger;
use Zimbra\Common\Struct\AccountSelector as Account;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RemoveAccountLoggerRequest extends Request
{
    /**
     * Logger category
     * @Accessor(getter="getLogger", setter="setLogger")
     * @SerializedName("logger")
     * @Type("Zimbra\Admin\Struct\LoggerInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Logger $logger = NULL;

    /**
     * Use to select account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Account $account = NULL;

    /**
     * id
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAdmin")
     */
    private $id;

    /**
     * Constructor method for RemoveAccountLoggerRequest
     *
     * @param  Logger $logger
     * @param  Account $account
     * @param  string $id
     * @return self
     */
    public function __construct(
        ?Logger $logger = NULL, ?Account $account = NULL, ?string $id = NULL
    )
    {
        if ($logger instanceof Logger) {
            $this->setLogger($logger);
        }
        if ($account instanceof Account) {
            $this->setAccount($account);
        }
        if (NULL !== $id) {
            $this->setId($id);
        }
    }

    /**
     * Gets the logger.
     *
     * @return Logger
     */
    public function getLogger(): ?Logger
    {
        return $this->logger;
    }

    /**
     * Sets the logger.
     *
     * @param  Logger $logger
     * @return self
     */
    public function setLogger(Logger $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * Sets the account.
     *
     * @return Account
     */
    public function getAccount(): ?Account
    {
        return $this->account;
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
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
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new RemoveAccountLoggerEnvelope(
            new RemoveAccountLoggerBody($this)
        );
    }
}
