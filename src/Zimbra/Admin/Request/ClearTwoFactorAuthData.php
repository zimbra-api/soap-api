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

use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Struct\AccountSelector;

/**
 * ClearTwoFactorAuthData request class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ClearTwoFactorAuthData extends Base
{
    /**
     * Constructor method for ClearTwoFactorAuthData
     * @param CosSelector $cos
     * @param AccountSelector $account
     * @return self
     */
    public function __construct(CosSelector $cos, AccountSelector $account)
    {
        parent::__construct();
        $this->setChild('cos', $cos);
        $this->setChild('account', $account);
    }

    /**
     * Gets the cos.
     *
     * @return CosSelector
     */
    public function getCos()
    {
        return $this->getChild('cos');
    }

    /**
     * Sets the cos.
     *
     * @param  CosSelector $cos
     * @return self
     */
    public function setCos(CosSelector $cos)
    {
        return $this->setChild('cos', $cos);
    }

    /**
     * Gets the account.
     *
     * @return AccountSelector
     */
    public function getAccount()
    {
        return $this->getChild('account');
    }

    /**
     * Sets the account.
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account)
    {
        return $this->setChild('account', $account);
    }
}
