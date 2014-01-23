<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Struct\AccountSelector as Account;

/**
 * DelegateAuth request class
 * Used to request a new auth token that is valid for the specified account.
 * The id of the auth token will be the id of the target account, and the requesting admin's id will be stored in the auth token for auditing purposes.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DelegateAuth extends Request
{
    /**
     * Constructor method for DelegateAuth
     * @param  Account $account Details of target account
     * @param  int $duration Lifetime in seconds of the newly-created authtoken. defaults to 1 hour.
     * @return self
     */
    public function __construct(Account $account, $duration = null)
    {
        parent::__construct();
        $this->child('account', $account);
        if(null !== $duration)
        {
            $this->property('duration', (int) $duration);
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
     * Gets or sets duration
     *
     * @param  int $duration
     * @return int|self
     */
    public function duration($duration = null)
    {
        if(null === $duration)
        {
            return $this->property('duration');
        }
        return $this->property('duration', (int) $duration);
    }
}
