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
 * GetAccount request class
 * Get attributes related to an account.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAccount extends Request
{
    /**
     * Constructor method for GetAccount
     * @param  Account $account Account
     * @param  bool $applyCos Flag whether or not to apply class of service (COS) rules
     * @param  string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(Account $account = null, $applyCos = null, $attrs = null)
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->child('account', $account);
        }
        if(null !== $applyCos)
        {
            $this->property('applyCos', (bool) $applyCos);
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
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
     * Gets or sets applyCos
     *
     * @param  bool $applyCos
     * @return bool|self
     */
    public function applyCos($applyCos = null)
    {
        if(null === $applyCos)
        {
            return $this->property('applyCos');
        }
        return $this->property('applyCos', (bool) $applyCos);
    }

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->property('attrs');
        }
        return $this->property('attrs', trim($attrs));
    }
}
