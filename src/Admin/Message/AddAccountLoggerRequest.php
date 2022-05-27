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
use Zimbra\Soap\Request;
use Zimbra\Common\Struct\AccountSelector as Account;

/**
 * AddAccountLoggerRequest request class
 * Changes logging settings on a per-account basis
 * Adds a custom logger for the given account and log category.
 * The logger stays in effect only during the lifetime of the current server instance.
 * If the request is sent to a server other than the one that the account resides on, it is proxied to the correct server.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AddAccountLoggerRequest extends Request
{
    /**
     * Logger category
     * @Accessor(getter="getLogger", setter="setLogger")
     * @SerializedName("logger")
     * @Type("Zimbra\Admin\Struct\LoggerInfo")
     * @XmlElement
     */
    private Logger $logger;

    /**
     * Use to select account
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Common\Struct\AccountSelector")
     * @XmlElement
     */
    private ?Account $account = NULL;

    /**
     * id
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $id;

    /**
     * Constructor method for AddAccountLoggerRequest
     *
     * @param  Logger $logger
     * @param  Account $account
     * @param  string $id
     * @return self
     */
    public function __construct(Logger $logger, ?Account $account = NULL, ?string $id = NULL)
    {
        $this->setLogger($logger);
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
    public function getLogger(): Logger
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
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof AddAccountLoggerEnvelope)) {
            $this->envelope = new AddAccountLoggerEnvelope(
                new AddAccountLoggerBody($this)
            );
        }
    }
}
