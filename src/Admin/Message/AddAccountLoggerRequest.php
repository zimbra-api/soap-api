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
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AddAccountLoggerRequest extends SoapRequest
{
    /**
     * Logger category
     * 
     * @var LoggerInfo
     */
    #[Accessor(getter: 'getLogger', setter: 'setLogger')]
    #[SerializedName('logger')]
    #[Type(LoggerInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private LoggerInfo $logger;

    /**
     * Use to select account
     * 
     * @var AccountSelector
     */
    #[Accessor(getter: 'getAccount', setter: 'setAccount')]
    #[SerializedName('account')]
    #[Type(AccountSelector::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private ?AccountSelector $account;

    /**
     * id
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraAdmin')]
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
        LoggerInfo $logger, ?AccountSelector $account = NULL, ?string $id = NULL
    )
    {
        $this->setLogger($logger);
        $this->account = $account;
        if (NULL !== $id) {
            $this->setId($id);
        }
    }

    /**
     * Get the logger.
     *
     * @return LoggerInfo
     */
    public function getLogger(): LoggerInfo
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
        return new AddAccountLoggerEnvelope(
            new AddAccountLoggerBody($this)
        );
    }
}
