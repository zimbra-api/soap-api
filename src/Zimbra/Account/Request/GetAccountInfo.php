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
 * GetAccountInfo request class
 * Get Information about an account
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAccountInfo extends Base
{
    /**
     * Constructor method for GetAccountInfo
     * @param  Account $account Use to identify the account
     * @return self
     */
    public function __construct(Account $account)
    {
        parent::__construct();
        $this->child('account', $account);
    }

    /**
     * Gets or sets account
     *
     * @param  Account $account
     * @return Account|GetAccountInfo
     */
    public function account(Account $account = null)
    {
        if(null === $account)
        {
            return $this->child('account');
        }
        return $this->child('account', $account);
    }
}
