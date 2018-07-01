<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlRoot;

use Zimbra\Struct\AccountSelector as Account;
use Zimbra\Admin\Struct\LoggerInfo as Logger;
use Zimbra\Soap\ClientInterface;
use Zimbra\Soap\Request;

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
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 * @XmlRoot(name="AddAccountLoggerRequest")
 */
class AddAccountLoggerRequest extends Request
{

    /**
     * @Accessor(getter="getLogger", setter="setLogger")
     * @SerializedName("logger")
     * @Type("Zimbra\Admin\Struct\LoggerInfo")
     * @XmlElement
     */
    private $_logger;


    /**
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $_account;

    /**
     * Constructor method for AddAccountLogger
     * @param  Logger $logger Logger category
     * @param  Account $account Use to select account
     * @return self
     */
    public function __construct(Logger $logger, Account $account = null)
    {
        $this->setLogger($logger);
        if ($account instanceof Account) {
            $this->setAccount($account);
        }
    }

    /**
     * Gets the logger.
     *
     * @return Logger
     */
    public function getLogger()
    {
        return $this->_logger;
    }

    /**
     * Sets the logger.
     *
     * @param  Logger $logger
     * @return self
     */
    public function setLogger(Logger $logger)
    {
        $this->_logger = $logger;
        return $this;
    }

    /**
     * Sets the account.
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->_account;
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account)
    {
        $this->_account = $account;
        return $this;
    }

    public function execute(ClientInterface $client)
    {
        $requestEnvelope = new AddAccountLoggerEnvelope();
        $requestEnvelope->setBody(new AddAccountLoggerBody($this));
        $response = $client->doRequest(
            $this->getSerializer()->serialize($requestEnvelope, 'xml')
        );
        $responseEnvelope = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            'Zimbra\Admin\Message\AddAccountLoggerEnvelope', 'xml'
        );
        return $responseEnvelope->getBody()->getResponse();
    }
}
