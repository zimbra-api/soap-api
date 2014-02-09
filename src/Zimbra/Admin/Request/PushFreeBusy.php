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
            $this->child('domain', $domain);
        }
        if($account instanceof Id)
        {
            $this->child('account', $account);
        }
    }

    /**
     * Gets or sets cos
     *
     * @param  Names $cos
     * @return Names|self
     */
    public function domain(Names $domain = null)
    {
        if(null === $domain)
        {
            return $this->child('domain');
        }
        return $this->child('domain', $domain);
    }

    /**
     * Gets or sets account
     *
     * @param  Id $account
     * @return Id|self
     */
    public function account(Id $account = null)
    {
        if(null === $account)
        {
            return $this->child('account');
        }
        return $this->child('account', $account);
    }
}
