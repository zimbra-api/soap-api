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
class GetAdminConsoleUIComp extends Base
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
            $this->setChild('account', $account);
        }
        if($dl instanceof DistList)
        {
            $this->setChild('dl', $dl);
        }
    }

    /**
     * Gets the account.
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->getChild('account');
    }

    /**
     * Sets the account.
     *
     * @param  Account $account
     * @return self
     */
    public function setAccount(Account $account)
    {
        return $this->setChild('account', $account);
    }

    /**
     * Gets the dl.
     *
     * @return DistList
     */
    public function getDl()
    {
        return $this->getChild('dl');
    }

    /**
     * Sets the dl.
     *
     * @param  DistList $dl
     * @return self
     */
    public function setDl(DistList $dl)
    {
        return $this->setChild('dl', $dl);
    }
}
