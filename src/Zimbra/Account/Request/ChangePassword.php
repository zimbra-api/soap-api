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
        if($account instanceof Account)
        {
            $this->child('account', $account);
        }
        if(null !== $oldPassword)
        {
            $this->child('oldPassword', trim($oldPassword));
        }
        if(null !== $password)
        {
            $this->child('password', trim($password));
        }
        if(null !== $virtualHost)
        {
            $this->child('virtualHost', trim($virtualHost));
        }
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
            return $this->child('account');
        }
        return $this->child('account', $account);
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
            return $this->child('oldPassword');
        }
        return $this->child('oldPassword', trim($oldPassword));
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
            return $this->child('password');
        }
        return $this->child('password', trim($password));
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
            return $this->child('virtualHost');
        }
        return $this->child('virtualHost', trim($virtualHost));
    }
}
