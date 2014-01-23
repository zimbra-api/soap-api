<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Enum\AuthScheme;
use Zimbra\Struct\Base;

/**
 * ExchangeAuthSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExchangeAuthSpec extends Base
{
    /**
     * Constructor method for ExchangeAuthSpec
     * @param string $url URL to Exchange server
     * @param string $user Exchange user
     * @param string $pass Exchange password
     * @param AuthScheme $scheme Auth scheme
     * @param string $type Auth type
     * @return self
     */
    public function __construct(
        $url,
        $user,
        $pass,
        AuthScheme $scheme,
        $type = null
    )
    {
        parent::__construct();
        $this->property('url', trim($url));
        $this->property('user', trim($user));
        $this->property('pass', trim($pass));
        $this->property('scheme', $scheme);
        if(null !== $type)
        {
            $this->property('type', trim($type));
        }
    }

    /**
     * Gets or sets url
     *
     * @param  string $url
     * @return string|self
     */
    public function url($url = null)
    {
        if(null === $url)
        {
            return $this->property('url');
        }
        return $this->property('url', trim($url));
    }

    /**
     * Gets or sets user
     *
     * @param  string $user
     * @return string|self
     */
    public function user($user = null)
    {
        if(null === $user)
        {
            return $this->property('user');
        }
        return $this->property('user', trim($user));
    }

    /**
     * Gets or sets pass
     *
     * @param  string $pass
     * @return string|self
     */
    public function pass($pass = null)
    {
        if(null === $pass)
        {
            return $this->property('pass');
        }
        return $this->property('pass', trim($pass));
    }

    /**
     * Gets or sets scheme
     *
     * @param  AuthScheme $scheme
     * @return AuthScheme|self
     */
    public function scheme(AuthScheme $scheme = null)
    {
        if(null === $scheme)
        {
            return $this->property('scheme');
        }
        return $this->property('scheme', $scheme);
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', trim($type));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'auth')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'auth')
    {
        return parent::toXml($name);
    }
}
