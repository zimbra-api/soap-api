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
 * @copyright  Copyright © 2013 scheme Nguyen Van Nguyen.
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
        $this->setProperty('url', trim($url));
        $this->setProperty('user', trim($user));
        $this->setProperty('pass', trim($pass));
        $this->setProperty('scheme', $scheme);
        if(null !== $type)
        {
            $this->setProperty('type', trim($type));
        }
    }

    /**
     * Gets URL to Exchange server
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->getProperty('url');
    }

    /**
     * Sets URL to Exchange server
     *
     * @param  string $url
     * @return self
     */
    public function setUrl($url)
    {
        return $this->setProperty('url', trim($url));
    }

    /**
     * Gets exchange user
     *
     * @return string
     */
    public function getAuthUserName()
    {
        return $this->getProperty('user');
    }

    /**
     * Sets exchange user
     *
     * @param  string $user
     * @return self
     */
    public function setAuthUserName($user)
    {
        return $this->setProperty('user', trim($user));
    }

    /**
     * Gets exchange password
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->getProperty('pass');
    }

    /**
     * Sets exchange password
     *
     * @param  string $pass
     * @return self
     */
    public function setAuthPassword($pass)
    {
        return $this->setProperty('pass', trim($pass));
    }

    /**
     * Gets scheme enum
     *
     * @return Zimbra\Enum\AuthScheme
     */
    public function getAuthScheme()
    {
        return $this->getProperty('scheme');
    }

    /**
     * Sets scheme enum
     *
     * @param  Zimbra\Enum\AuthScheme $scheme
     * @return self
     */
    public function setAuthScheme(AuthScheme $scheme)
    {
        return $this->setProperty('scheme', $scheme);
    }

    /**
     * Gets auth type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets auth type
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        return $this->setProperty('type', trim($type));
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
