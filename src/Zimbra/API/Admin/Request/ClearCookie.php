<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\CookieSpec as Cookie;

/**
 * ClearCookie class
 * Clear cookie.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ClearCookie extends Request
{
    /**
     * Specifies cookies to clean
     * @var array
     */
    private $_cookies = array();

    /**
     * Constructor method for ClearCookie
     * @param string $cookies
     * @return self
     */
    public function __construct(array $cookies = array())
    {
        parent::__construct();
        $this->cookies($cookies);
    }

    /**
     * Add a cookie spec
     *
     * @param  Cookie $cookies
     * @return self
     */
    public function addCookie(Cookie $cookie)
    {
        $this->_cookies[] = $cookie;
        return $this;
    }

    /**
     * Gets or sets cookies
     *
     * @param  array $cookies
     * @return array|self
     */
    public function cookies(array $cookies = null)
    {
        if(null === $cookies)
        {
            return $this->_cookies;
        }
        $this->_cookies = array();
        foreach ($cookies as $cookie)
        {
            if($cookie instanceof Cookie)
            {
                $this->_cookies[] = $cookie;
            }
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_cookies))
        {
            $this->array['cookie'] = array();
            foreach ($this->_cookies as $cookie)
            {
                $cookieArr = $cookie->toArray();
                $this->array['cookie'][] = $cookieArr['cookie'];
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        foreach ($this->_cookies as $cookie)
        {
            $this->xml->append($cookie->toXml());
        }
        return parent::toXml();
    }
}
