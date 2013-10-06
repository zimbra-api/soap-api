<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AccountSelector as Account;

/**
 * ChangePassword class
 * Change Password
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ChangePassword extends Request
{
    /**
     * Details of the account
     * @var Account
     */
    private $_account;

    /**
     * Old password
     * @var string
     */
    private $_oldPassword;

    /**
     * New Password to assign
     * @var string
     */
    private $_password;

    /**
     * If specified virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @var string
     */
    private $_virtualHost;

    /**
     * Constructor method for changePassword
     * @param  Account $account
     * @param  string    $oldPassword
     * @param  string    $password
     * @param  string    $virtualHost
     * @return self
     */
    public function __construct(
        Account $account,
        $oldPassword,
        $password,
        $virtualHost = null
    )
    {
        parent::__construct();
        $this->_account = $account;
        $this->_oldPassword = trim($oldPassword);
        $this->_password = trim($password);
        $this->_virtualHost = trim($virtualHost);
    }

    /**
     * Gets or sets account
     *
     * @param  Account $account
     * @return Account|self
     */
    public function account(Account $account = null)
    {
        if(null === $account)
        {
            return $this->_account;
        }
        $this->_account = $account;
        return $this;
    }

    /**
     * Gets or sets oldPassword
     *
     * @param  string $oldPassword
     * @return string|self
     */
    public function oldPassword($oldPassword = null)
    {
        if(null === $oldPassword)
        {
            return $this->_oldPassword;
        }
        $this->_oldPassword = trim($oldPassword);
        return $this;
    }

    /**
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->_password;
        }
        $this->_password = trim($password);
        return $this;
    }

    /**
     * Gets or sets virtualHost
     *
     * @param  string $virtualHost
     * @return string|self
     */
    public function virtualHost($virtualHost = null)
    {
        if(null === $virtualHost)
        {
            return $this->_virtualHost;
        }
        $this->_virtualHost = trim($virtualHost);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_account->toArray();
        $this->array['oldPassword'] = (string) $this->_oldPassword;
        $this->array['password'] = (string) $this->_password;
        if(!empty($this->_virtualHost))
        {
            $this->array['virtualHost'] = (string) $this->_virtualHost;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_account->toXml());
        $this->xml->addChild('oldPassword', (string) $this->_oldPassword);
        $this->xml->addChild('password', (string) $this->_password);
        if(!empty($this->_virtualHost))
        {
            $this->xml->addChild('virtualHost', (string) $this->_virtualHost);
        }
        return parent::toXml();
    }
}
