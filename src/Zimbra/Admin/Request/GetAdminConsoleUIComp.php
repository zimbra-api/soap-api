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
use Zimbra\Admin\Struct\DistributionListSelector as DistList;

/**
 * GetAdminConsoleUIComp request class
 * Returns the union of the zimbraAdminConsoleUIComponents values on the specified account/dl entry and that on all admin groups the entry belongs to.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAdminConsoleUIComp extends Request
{
    /**
     * Constructor method for GetAdminConsoleUIComp
     * @param  Account $account Account
     * @param  DistList $dl Distribution List
     * @return self
     */
    public function __construct(Account $account = null, DistList $dl = null)
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->child('account', $account);
        }
        if($dl instanceof DistList)
        {
            $this->child('dl', $dl);
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
     * Gets or sets dl
     *
     * @param  DistList $dl
     * @return DistList|self
     */
    public function dl(DistList $dl = null)
    {
        if(null === $dl)
        {
            return $this->child('dl');
        }
        return $this->child('dl', $dl);
    }
}
