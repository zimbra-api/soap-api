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
class ClearCookie extends Base
{
    /**
     * Specifies cookies to clean
     * @var TypedSequence<CookieSpec>
     */
    private $_cookies;

    /**
     * Constructor method for ClearCookie
     * @param array $cookies
     * @return self
     */
    public function __construct(array $cookies = [])
    {
        parent::__construct();
        $this->setCookies($cookies);

        $this->on('before', function(Base $sender)
        {
            if($sender->getCookies()->count())
            {
                $sender->setChild('cookie', $sender->getCookies()->all());
            }
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
        $this->_cookies->add($cookie);
        return $this;
    }

    /**
     * Sets cookie sequence
     *
     * @param array $cookies
     * @return Sequence
     */
    public function setCookies(array $cookies)
    {
        $this->_cookies = new TypedSequence('Zimbra\Admin\Struct\CookieSpec', $cookies);
        return $this;
    }

    /**
     * Gets cookie sequence
     *
     * @return Sequence
     */
    public function getCookies()
    {
        return $this->_cookies;
    }
}
