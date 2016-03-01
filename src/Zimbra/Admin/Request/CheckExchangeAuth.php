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

use Zimbra\Admin\Struct\ExchangeAuthSpec as Exchange;

/**
 * CheckExchangeAuth request class
 * Check Exchange Authorisation.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckExchangeAuth extends Base
{
    /**
     * Constructor method for CheckExchangeAuth
     * @param Exchange $auth Exchange auth details
     * @return self
     */
    public function __construct(Exchange $auth)
    {
        parent::__construct();
        $this->setChild('auth', $auth);
    }

    /**
     * Gets the auth.
     *
     * @return Exchange
     */
    public function getAuth()
    {
        return $this->getChild('auth');
    }

    /**
     * Sets the auth.
     *
     * @param  Exchange $auth
     * @return self
     */
    public function setAuth(Exchange $auth)
    {
        return $this->setChild('auth', $auth);
    }
}
