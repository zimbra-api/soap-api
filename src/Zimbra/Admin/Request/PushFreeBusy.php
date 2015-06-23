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

use Zimbra\Admin\Struct\Names;
use Zimbra\Struct\Id;

/**
 * PushFreeBusy request class
 * Push Free/Busy.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class PushFreeBusy extends Base
{
    /**
     * Constructor method for PushFreeBusy
     * @param Names $domain Domain names specification
     * @param Id $account Account ID
     * @return self
     */
    public function __construct(Names $domain = null, Id $account = null)
    {
        parent::__construct();
        if($domain instanceof Names)
        {
            $this->setChild('domain', $domain);
        }
        if($account instanceof Id)
        {
            $this->setChild('account', $account);
        }
    }

    /**
     * Gets the domain.
     *
     * @return Names
     */
    public function getDomain()
    {
        return $this->getChild('domain');
    }

    /**
     * Sets the domain.
     *
     * @param  Names $domain
     * @return self
     */
    public function setDomain(Names $domain)
    {
        return $this->setChild('domain', $domain);
    }

    /**
     * Gets the account.
     *
     * @return Id
     */
    public function getAccount()
    {
        return $this->getChild('account');
    }

    /**
     * Sets the account.
     *
     * @param  Id $account
     * @return self
     */
    public function setAccount(Id $account)
    {
        return $this->setChild('account', $account);
    }
}
