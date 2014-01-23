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

use Zimbra\Admin\Struct\CookieSpec as Cookie;
use Zimbra\Common\TypedSequence;
use Zimbra\Soap\Request;

/**
 * ClearCookie request class
 * Clear cookie.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ClearCookie extends Request
{
    /**
     * Specifies cookies to clean
     * @var TypedSequence<CookieSpec>
     */
    private $_cookie;

    /**
     * Constructor method for ClearCookie
     * @param array $cookie
     * @return self
     */
    public function __construct(array $cookie = array())
    {
        parent::__construct();
        $this->_cookie = new TypedSequence('Zimbra\Admin\Struct\CookieSpec', $cookie);

        $this->addHook(function($sender)
        {
            $sender->child('cookie', $sender->cookie()->all());
        });
    }

    /**
     * Add a cookie spec
     *
     * @param  Cookie $cookie
     * @return self
     */
    public function addCookie(Cookie $cookie)
    {
        $this->_cookie->add($cookie);
        return $this;
    }

    /**
     * Gets cookie sequence
     *
     * @return Sequence
     */
    public function cookie()
    {
        return $this->_cookie;
    }
}
