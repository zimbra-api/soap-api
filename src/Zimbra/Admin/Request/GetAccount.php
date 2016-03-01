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
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

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
class GetAccount extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for GetAccount
     * @param  Account $account Account
     * @param  bool $applyCos Flag whether or not to apply class of service (COS) rules
     * @param  array $attrs An array of attributes
     * @return self
     */
    public function __construct(Account $account = null, $applyCos = null, array $attrs = [])
    {
        parent::__construct();
        if($account instanceof Account)
        {
            $this->setChild('account', $account);
        }
        if(null !== $applyCos)
        {
            $this->setProperty('applyCos', (bool) $applyCos);
        }

        $this->setAttrs($attrs);
        $this->on('before', function(Base $sender)
        {
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
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
     * Gets applyCos
     *
     * @return bool
     */
    public function getApplyCos()
    {
        return $this->getProperty('applyCos');
    }

    /**
     * Sets applyCos
     *
     * @param  bool $applyCos
     * @return self
     */
    public function setApplyCos($applyCos)
    {
        return $this->setProperty('applyCos', (bool) $applyCos);
    }
}
