<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Struct\AccountSelector as Account;

/**
 * ChangePassword request class
 * Change Password
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ChangePassword extends Base
{
    /**
     * Constructor method for changePassword
     * @param  Account $account Details of the account
     * @param  string  $oldPassword Old password
     * @param  string  $password New Password to assign
     * @param  string  $virtualHost If specified virtual-host is used to determine the domain of the account name, if it does not include a domain component.
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
        $this->setChild('account', $account);
        $this->setChild('oldPassword', trim($oldPassword));
        $this->setChild('password', trim($password));
        if(null !== $virtualHost)
        {
            $this->setChild('virtualHost', trim($virtualHost));
        }
    }

    /**
     * Gets the account
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->getChild('account');
    }

    /**
     * Sets the account
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account)
    {
        return $this->setChild('account', $account);
    }

    /**
     * Gets old password
     *
     * @return string
     */
    public function getOldPassword()
    {
        return $this->getChild('oldPassword');
    }

    /**
     * Sets old password
     *
     * @param  string $oldPassword
     * @return self
     */
    public function setOldPassword($oldPassword)
    {
        return $this->setChild('oldPassword', trim($oldPassword));
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getChild('password');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setChild('password', trim($password));
    }

    /**
     * Gets virtual host
     *
     * @return string
     */
    public function getVirtualHost()
    {
        return $this->getChild('virtualHost');
    }

    /**
     * Sets virtual host
     *
     * @param  string $virtualHost
     * @return self
     */
    public function setVirtualHost($virtualHost)
    {
        return $this->setChild('virtualHost', trim($virtualHost));
    }
}
