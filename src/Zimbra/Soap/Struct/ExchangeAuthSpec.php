<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\AuthScheme;
use Zimbra\Utils\SimpleXML;

/**
 * ExchangeAuthSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ExchangeAuthSpec
{
    /**
     * URL to Exchange server
     * - use : required
     * @var string
     */
    private $_url;

    /**
     * Exchange user
     * - use : required
     * @var string
     */
    private $_user;

    /**
     * Exchange password
     * - use : required
     * @var string
     */
    private $_pass;

    /**
     * Auth scheme
     * - use : required
     * @var string
     */
    private $_scheme;

    /**
     * Auth type
     * @var string
     */
    private $_type;

    /**
     * Constructor method for exchangeAuthSpec
     * @param string $url
     * @param string $user
     * @param string $pass
     * @param string $scheme
     * @param string $type
     * @return self
     */
    public function __construct($url, $user, $pass, $scheme, $type = null)
    {
        $this->_url = trim($url);
        $this->_user = trim($user);
        $this->_pass = trim($pass);
        if(AuthScheme::isValid(trim($scheme)))
        {
            $this->_scheme = trim($scheme);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid scheme');
        }
        $this->_type = trim($type);
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
            return $this->_url;
        }
        $this->_url = trim($url);
        return $this;
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
            return $this->_user;
        }
        $this->_user = trim($user);
        return $this;
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
            return $this->_pass;
        }
        $this->_pass = trim($pass);
        return $this;
    }

    /**
     * Gets or sets scheme
     *
     * @param  string $scheme
     * @return string|self
     */
    public function scheme($scheme = null)
    {
        if(null === $scheme)
        {
            return $this->_scheme;
        }
        if(AuthScheme::isValid(trim($scheme)))
        {
            $this->_scheme = trim($scheme);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid scheme');
        }
        return $this;
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
            return $this->_type;
        }
        $this->_type = trim($type);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'auth')
    {
        $name = !empty($name) ? $name : 'auth';
        $arr = array(
            'url' => $this->_url,
            'user' => $this->_user,
            'pass' => $this->_pass,
            'scheme' => $this->_scheme,
        );
        if(!empty($this->_type))
        {
            $arr['type'] = $this->_type;
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'auth')
    {
        $name = !empty($name) ? $name : 'auth';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('url', $this->_url)
            ->addAttribute('user', $this->_user)
            ->addAttribute('pass', $this->_pass)
            ->addAttribute('scheme', $this->_scheme);
        if(!empty($this->_type))
        {
            $xml->addAttribute('type', $this->_type);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
