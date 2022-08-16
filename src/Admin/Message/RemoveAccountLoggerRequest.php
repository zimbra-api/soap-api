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
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

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
     * @var Logger
     */
    #[Accessor(getter: 'getLogger', setter: 'setLogger')]
    #[SerializedName(name: 'logger')]
    #[Type(name: Logger::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $logger;

    /**
     * Use to select account
     * 
     * @var Account
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName(name: 'account')]
    #[Type(name: Account::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $account;

    /**
     * id
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false,namespace: 'urn:zimbraAdmin')]
    private $id;

    /**
     * Constructor
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
     * Get the logger.
     *
     * @return Logger
     */
    public function getLogger(): ?Logger
    {
        return $this->logger;
    }

    /**
     * Set the logger.
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
     * Set the account.
     *
     * @return Account
     */
    public function getAccount(): ?Account
    {
        return $this->account;
    }

    /**
     * Set the account.
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
