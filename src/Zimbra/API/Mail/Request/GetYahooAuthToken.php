<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;

/**
 * GetYahooAuthToken request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetYahooAuthToken extends Request
{
    /**
     * User
     * @var string
     */
    private $_user;

    /**
     * Password
     * @var string
     */
    private $_password;

    /**
     * Constructor method for GetYahooAuthToken
     * @param  string $user
     * @param  string $password
     * @return self
     */
    public function __construct($user, $password)
    {
        parent::__construct();
        $this->_user = trim($user);
        $this->_password = trim($password);
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
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->_password;
        }
        $this->_password = trim($password);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['user'] = $this->_user;
        $this->array['password'] = $this->_password;
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('user', $this->_user)
                  ->addAttribute('password', $this->_password);
        return parent::toXml();
    }
}
